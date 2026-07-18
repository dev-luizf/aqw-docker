#!/usr/bin/env python3
"""Audit and fix game asset paths stored in the SQL dump."""

from __future__ import annotations

import argparse
import difflib
import re
import urllib.parse
from collections import Counter, defaultdict
from dataclasses import dataclass
from pathlib import Path


INSERT_RE = re.compile(r"^INSERT INTO `([^`]+)` \((.+)\) VALUES$")
ASSET_TABLES = {"hairs", "items", "maps", "monsters"}


@dataclass
class Field:
    value: str
    start: int
    end: int
    quoted: bool


@dataclass
class Reference:
    table: str
    row_id: str
    name: str
    item_type: str
    path: str
    line_index: int
    field: Field


def parse_fields(line: str) -> list[Field]:
    """Parse a single-line SQL tuple and retain each field's source span."""
    fields: list[Field] = []
    index = line.find("(") + 1
    tuple_end = line.rfind(")")

    while 0 < index < tuple_end:
        while index < tuple_end and line[index].isspace():
            index += 1
        start = index
        quoted = index < tuple_end and line[index] == "'"

        if quoted:
            index += 1
            value_start = index
            chunks: list[str] = []
            chunk_start = index
            while index < tuple_end:
                if line[index] == "\\" and index + 1 < tuple_end:
                    chunks.append(line[chunk_start:index])
                    chunks.append(line[index + 1])
                    index += 2
                    chunk_start = index
                    continue
                if line[index] == "'":
                    if index + 1 < tuple_end and line[index + 1] == "'":
                        chunks.append(line[chunk_start:index])
                        chunks.append("'")
                        index += 2
                        chunk_start = index
                        continue
                    chunks.append(line[chunk_start:index])
                    index += 1
                    break
                index += 1
            value = "".join(chunks)
        else:
            while index < tuple_end and line[index] != ",":
                index += 1
            value = line[start:index].strip()

        fields.append(Field(value=value, start=start, end=index, quoted=quoted))
        while index < tuple_end and (line[index].isspace() or line[index] == ","):
            index += 1

    return fields


def read_references(lines: list[str]) -> list[Reference]:
    references: list[Reference] = []
    table: str | None = None
    columns: list[str] = []

    for line_index, line in enumerate(lines):
        match = INSERT_RE.match(line.rstrip("\n"))
        if match:
            table = match.group(1)
            columns = re.findall(r"`([^`]+)`", match.group(2))
            continue
        if table not in ASSET_TABLES or not line.startswith("("):
            continue

        fields = parse_fields(line)
        if len(fields) != len(columns):
            raise ValueError(
                f"Could not parse {table} row on line {line_index + 1}: "
                f"expected {len(columns)} fields, found {len(fields)}"
            )
        values = {column: field.value for column, field in zip(columns, fields)}
        file_index = columns.index("File")
        references.append(
            Reference(
                table=table,
                row_id=values["id"],
                name=values.get("Name", ""),
                item_type=values.get("Type", ""),
                path=values["File"],
                line_index=line_index,
                field=fields[file_index],
            )
        )
        if line.rstrip().endswith(";"):
            table = None
            columns = []

    return references


class AssetIndex:
    def __init__(self, gamefiles: Path) -> None:
        self.gamefiles = gamefiles
        self.paths = sorted(
            path.relative_to(gamefiles).as_posix()
            for path in gamefiles.rglob("*")
            if path.is_file()
        )
        self.exact = set(self.paths)
        self.casefolded: dict[str, list[str]] = defaultdict(list)
        for path in self.paths:
            self.casefolded[path.casefold()].append(path)

    def case_matches(self, path: str) -> list[str]:
        return self.casefolded[path.casefold()]

    def basename_matches(self, scope: str, path: str) -> list[str]:
        prefix = f"{scope.casefold().rstrip('/')}/"
        basename = Path(path).name.casefold()
        return [
            candidate
            for candidate in self.paths
            if candidate.casefold().startswith(prefix)
            and Path(candidate).name.casefold() == basename
        ]


def expected_paths(reference: Reference) -> tuple[str, list[str]]:
    clean = urllib.parse.unquote(reference.path.strip().replace("\\", "/"))
    clean = re.sub(r"^https?://[^/]+/(?:game/)?gamefiles/", "", clean)
    clean = clean.removeprefix("/gamefiles/").lstrip("/")
    clean = "/".join(part.strip() for part in clean.split("/"))
    if reference.table == "hairs":
        scope = str(Path(clean).parent).replace("\\", "/")
        return scope, [clean]
    if reference.table == "maps":
        return "maps", [f"maps/{clean}"]
    if reference.table == "monsters":
        return "mon", [f"mon/{clean}"]
    if clean.casefold().startswith("items/"):
        return "items", [clean]
    if reference.item_type.casefold() in {"armor", "class"}:
        return "classes", [f"classes/M/{clean}", f"classes/F/{clean}"]
    return "items", [clean]


def replacement_value(reference: Reference, actual_path: str) -> str:
    if reference.table == "hairs":
        return actual_path
    if reference.table == "maps":
        return actual_path.removeprefix("maps/")
    if reference.table == "monsters":
        return actual_path.removeprefix("mon/")
    if reference.item_type.casefold() in {"armor", "class"}:
        return actual_path.split("/", 2)[-1]
    return actual_path


def classify(
    reference: Reference, index: AssetIndex
) -> tuple[str, str | None, list[str]]:
    if not reference.path.strip():
        return "no_file", None, []

    area, expected = expected_paths(reference)

    exact = [path for path in expected if path in index.exact]
    if exact:
        replacement = replacement_value(reference, exact[0])
        if replacement != reference.path:
            return "format", replacement, exact
        return "ok", None, exact

    case_matches = sorted(
        {match for path in expected for match in index.case_matches(path)}
    )
    replacement_values = {
        replacement_value(reference, match) for match in case_matches
    }
    if case_matches and len(replacement_values) == 1:
        return "capitalization", replacement_values.pop(), case_matches

    basename_matches = index.basename_matches(area, expected[0])
    replacement_values = {
        replacement_value(reference, match) for match in basename_matches
    }
    if basename_matches and len(replacement_values) == 1:
        return "relocated", replacement_values.pop(), basename_matches

    repaired_expected: list[str] = []
    for path in expected:
        lowered = path.casefold()
        if lowered.endswith(".sw"):
            repaired_expected.append(path + "f")
        elif lowered.endswith(".swf.swf"):
            repaired_expected.append(path[:-4])
        elif not Path(path).suffix:
            repaired_expected.append(path + ".swf")
    repaired_matches = sorted(
        {
            match
            for path in repaired_expected
            for match in ([path] if path in index.exact else index.case_matches(path))
        }
    )
    replacement_values = {
        replacement_value(reference, match) for match in repaired_matches
    }
    if repaired_matches and len(replacement_values) == 1:
        return "repaired", replacement_values.pop(), repaired_matches

    basename = Path(reference.path).name.strip()
    repaired_basenames: set[str] = set()
    lowered_basename = basename.casefold()
    if lowered_basename.endswith(".swf.swf"):
        repaired_basenames.add(basename[:-4])
    elif lowered_basename.endswith(".swf"):
        repaired_basenames.add(basename + ".swf")
    repeated = re.match(r"^(.+?\.swf)\1.*$", reference.path, flags=re.IGNORECASE)
    if repeated:
        repaired_basenames.add(Path(repeated.group(1)).name)
    basename_repairs = sorted(
        {
            match
            for candidate in repaired_basenames
            for match in index.basename_matches(area, candidate)
        }
    )
    replacement_values = {
        replacement_value(reference, match) for match in basename_repairs
    }
    if basename_repairs and len(replacement_values) == 1:
        return "repaired", replacement_values.pop(), basename_repairs

    area_paths = [path for path in index.paths if path.startswith(f"{area}/")]
    fuzzy = difflib.get_close_matches(
        basename.casefold(),
        [Path(path).name.casefold() for path in area_paths],
        n=5,
        cutoff=0.88,
    )
    fuzzy_paths = sorted(
        {
            path
            for candidate in fuzzy
            for path in area_paths
            if Path(path).name.casefold() == candidate
        }
    )
    return "missing", None, fuzzy_paths


def sql_quote(value: str) -> str:
    return "'" + value.replace("\\", "\\\\").replace("'", "''") + "'"


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("dump", type=Path)
    parser.add_argument("gamefiles", type=Path)
    parser.add_argument("--fix", action="store_true")
    parser.add_argument("--show-ok", action="store_true")
    args = parser.parse_args()

    lines = args.dump.read_text(encoding="utf-8").splitlines(keepends=True)
    references = read_references(lines)
    index = AssetIndex(args.gamefiles)
    counts: Counter[str] = Counter()
    fixes: dict[int, tuple[Field, str]] = {}

    for reference in references:
        status, replacement, candidates = classify(reference, index)
        counts[status] += 1
        if status != "ok" or args.show_ok:
            suffix = f" -> {replacement}" if replacement is not None else ""
            candidate_text = (
                f" (candidates: {', '.join(candidates)})" if candidates else ""
            )
            print(
                f"{status:14} {reference.table}:{reference.row_id} "
                f"{reference.name!r} {reference.path!r}{suffix}{candidate_text}"
            )
        if args.fix and replacement is not None and replacement != reference.path:
            fixes[reference.line_index] = (reference.field, replacement)

    if args.fix and fixes:
        for line_index, (field, replacement) in fixes.items():
            line = lines[line_index]
            replacement_sql = sql_quote(replacement)
            lines[line_index] = (
                line[: field.start] + replacement_sql + line[field.end :]
            )
        args.dump.write_text("".join(lines), encoding="utf-8")

    print("summary", " ".join(f"{key}={counts[key]}" for key in sorted(counts)))
    print(f"references={len(references)} files={len(index.paths)} fixes={len(fixes)}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
