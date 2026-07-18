# Armagedom Worlds

Run your own AQW private server on your computer with Docker. The website,
game server, and database are started automatically.

## What you need

- [Docker Desktop](https://docs.docker.com/get-started/get-docker/)
- This project downloaded and extracted

## Start the server

Open a terminal inside the project folder.

On Windows (PowerShell):

```powershell
Copy-Item .env.example .env
docker compose up --build -d
```

On macOS or Linux:

```bash
cp .env.example .env
docker compose up --build -d
```

The first start may take a few minutes. When it finishes, open:

**http://127.0.0.1:8081**

Click **Play** to create a character and enter the game.

## Stop or start it again

Your characters and progress are saved when the server stops.

```bash
# Stop
docker compose down

# Start again
docker compose up -d
```

## Problems?

Make sure Docker Desktop is running, then check the server status:

```bash
docker compose ps
```

To see error messages:

```bash
docker compose logs
```

This setup is for playing locally on the same computer. Hosting it on the
internet requires extra security and network configuration.
