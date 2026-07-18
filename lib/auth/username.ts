export const usernamePattern = /^[a-zA-Z0-9_-]+$/;

export function normalizeUsername(value: string) {
  return value.trim().toLowerCase();
}

export function isValidUsername(value: string) {
  const trimmed = value.trim();
  return trimmed.length >= 3 && trimmed.length <= 32 && usernamePattern.test(trimmed);
}
