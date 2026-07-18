package main

import (
	"flag"
	"io"
	"log"
	"net"
	"net/http"
	"os"
	"strings"
	"time"

	"golang.org/x/net/websocket"
)

func getenv(key, fallback string) string {
	if v := os.Getenv(key); v != "" {
		return v
	}
	return fallback
}

func indexByte(b []byte, c byte) int {
	for i, v := range b {
		if v == c {
			return i
		}
	}
	return -1
}

// Bridges Ruffle WebSocket traffic to SmartFox TCP (null-delimited frames).
func flashSocketProxy(gameAddr string) http.Handler {
	server := websocket.Server{
		Handshake: func(cfg *websocket.Config, r *http.Request) error {
			return nil
		},
		Handler: func(ws *websocket.Conn) {
			defer ws.Close()
			ws.PayloadType = websocket.BinaryFrame

			tcp, err := net.Dial("tcp", gameAddr)
			if err != nil {
				log.Printf("flash socket proxy dial %s: %v", gameAddr, err)
				return
			}
			defer tcp.Close()
			log.Printf("flash socket proxy connected %s -> %s", ws.Request().RemoteAddr, gameAddr)

			errCh := make(chan error, 2)

			go func() {
				buf := make([]byte, 32*1024)
				var pending []byte
				for {
					n, readErr := ws.Read(buf)
					if n > 0 {
						pending = append(pending, buf[:n]...)
						for {
							i := indexByte(pending, 0)
							if i < 0 {
								break
							}
							msg := pending[:i+1]
							pending = pending[i+1:]
							if len(msg) == 1 {
								continue
							}
							if _, writeErr := tcp.Write(msg); writeErr != nil {
								errCh <- writeErr
								return
							}
						}
					}
					if readErr != nil {
						if len(pending) > 0 {
							_, _ = tcp.Write(append(pending, 0))
						}
						errCh <- readErr
						return
					}
				}
			}()

			go func() {
				buf := make([]byte, 32*1024)
				var pending []byte
				for {
					n, readErr := tcp.Read(buf)
					if n > 0 {
						pending = append(pending, buf[:n]...)
						for {
							i := indexByte(pending, 0)
							if i < 0 {
								break
							}
							msg := pending[:i+1]
							pending = pending[i+1:]
							if len(msg) == 1 {
								continue
							}
							if _, writeErr := ws.Write(msg); writeErr != nil {
								errCh <- writeErr
								return
							}
						}
					}
					if readErr != nil {
						errCh <- readErr
						return
					}
				}
			}()

			if err := <-errCh; err != nil && err != io.EOF {
				log.Printf("flash socket proxy closed: %v", err)
			}
		},
	}
	return server
}

func main() {
	healthcheck := flag.Bool("healthcheck", false, "check the local proxy health endpoint")
	flag.Parse()

	host := getenv("GAME_HOST", "game")
	port := strings.TrimPrefix(getenv("GAME_PORT", "5588"), ":")
	listen := getenv("PROXY_LISTEN", ":9001")
	gameAddr := host + ":" + port

	if *healthcheck {
		_, healthPort, err := net.SplitHostPort(listen)
		if err != nil {
			log.Fatalf("invalid PROXY_LISTEN %q: %v", listen, err)
		}
		client := http.Client{Timeout: 2 * time.Second}
		resp, err := client.Get("http://127.0.0.1:" + healthPort + "/healthz")
		if err != nil {
			log.Fatal(err)
		}
		defer resp.Body.Close()
		if resp.StatusCode != http.StatusOK {
			log.Fatalf("healthcheck returned %s", resp.Status)
		}
		return
	}

	mux := http.NewServeMux()
	mux.Handle("/flash-socket-proxy", flashSocketProxy(gameAddr))
	mux.HandleFunc("/healthz", func(w http.ResponseWriter, r *http.Request) {
		w.WriteHeader(http.StatusOK)
		_, _ = w.Write([]byte("ok"))
	})

	log.Printf("Ruffle WS→TCP proxy listening on %s → %s", listen, gameAddr)
	log.Fatal(http.ListenAndServe(listen, mux))
}
