# syntax=docker/dockerfile:1

FROM golang:1.22-bookworm AS builder
WORKDIR /src
COPY go.mod go.sum ./
RUN go mod download
COPY main.go ./
RUN CGO_ENABLED=0 go build -o /out/ruffle-proxy .

FROM debian:bookworm-slim
RUN apt-get update \
  && apt-get install -y --no-install-recommends ca-certificates \
  && rm -rf /var/lib/apt/lists/*
COPY --from=builder /out/ruffle-proxy /usr/local/bin/ruffle-proxy
ENV GAME_HOST=game \
    GAME_PORT=5588 \
    PROXY_LISTEN=:9001
EXPOSE 9001
ENTRYPOINT ["/usr/local/bin/ruffle-proxy"]
