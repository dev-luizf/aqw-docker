# syntax=docker/dockerfile:1

FROM golang:1.26-bookworm AS builder
WORKDIR /src
COPY go.mod go.sum ./
RUN --mount=type=cache,target=/go/pkg/mod go mod download
COPY main.go ./
RUN --mount=type=cache,target=/root/.cache/go-build \
  CGO_ENABLED=0 go build -trimpath -ldflags="-s -w" -o /out/ruffle-proxy .

FROM gcr.io/distroless/static-debian12:nonroot
COPY --from=builder --chown=nonroot:nonroot /out/ruffle-proxy /usr/local/bin/ruffle-proxy
ENV GAME_HOST=game \
    GAME_PORT=5588 \
    PROXY_LISTEN=:9001
USER nonroot:nonroot
EXPOSE 9001
ENTRYPOINT ["/usr/local/bin/ruffle-proxy"]
