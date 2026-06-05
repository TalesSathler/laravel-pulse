# Laravel Pulse

A Laravel 13 application with Vue.js frontend, featuring real-time application monitoring via [Laravel Pulse](https://github.com/laravel/pulse), queue management via [Laravel Horizon](https://github.com/laravel/horizon), debugging via [Laravel Telescope](https://github.com/laravel/telescope), and reverse proxy routing via [Traefik](https://traefik.io/).

## Tech Stack

- **Backend**: Laravel 13, PHP 8.5
- **Frontend**: Vue 3, Inertia.js, Vite, TypeScript
- **Database**: PostgreSQL 16
- **Cache/Queue**: Redis
- **Auth**: Laravel Fortify
- **Monitoring**: Laravel Pulse, Telescope, Horizon
- **Infrastructure**: Docker, Nginx, Supervisor, Traefik

## Quick Start

```bash
./build.sh
```

This builds containers, installs dependencies, and starts all services. The application will be available at `http://laravel-pulse.localhost/` (via Traefik — add `127.0.0.1 laravel-pulse.localhost` to `/etc/hosts`).

## Services

| Service        | Container                          | Port                              |
|----------------|------------------------------------|-----------------------------------|
| Traefik        | laravel-pulse-traefik              | `80` → `80`, `8080` (dashboard)   |
| App (x2)       | laravelpulse-app-{1,2}             | —                                 |
| Web Server     | laravelpulse-webserver-{1,2}       | `80` (internal, via Traefik)      |
| Database       | laravel-pulse-postgres             | `5432`                            |
| Pulse DB       | laravel-pulse-postgres-dedicated   | `5433`                            |
| Cache          | laravel-pulse-redis                | —                                 |
| Worker         | laravel-pulse-worker               | — (Horizon + pulse:check via Supervisor) |
| Vite           | laravel-pulse-vite                 | `5173`                            |

### Access Points

| Service   | URL                              |
|-----------|----------------------------------|
| App       | `http://laravel-pulse.localhost/`      |
| Pulse     | `http://laravel-pulse.localhost/pulse` |
| Horizon   | `http://laravel-pulse.localhost/horizon` |
| Telescope | `http://laravel-pulse.localhost/telescope` |
| Traefik   | `http://localhost:8080/`         |

## Architecture

- **Traefik** acts as the reverse proxy, routing `laravel-pulse.localhost` traffic to the Nginx webserver replicas.
- **Pulse** stores monitoring data in a dedicated PostgreSQL database (`pulse` connection).
- **Horizon** manages queue workers via Supervisor inside the `worker` container.
- **Telescope** provides request-level debugging (local environment only).
- **Supervisor** runs inside the worker container, managing Horizon and `pulse:check` processes.

## Development

The `docker-compose.override.yml` mounts the application source for live reloading:

```bash
docker compose up -d
```

### Commands

```bash
# Lint PHP
composer lint

# Run tests
composer test

# Clear all caches
php artisan optimize:clear

# Clear Pulse data
php artisan pulse:clear
```

## Configuration

Key environment variables are in `.env`:

- `DB_HOST` / `PULSE_DB_HOST` — database hosts
- `REDIS_HOST` — Redis host
- `QUEUE_CONNECTION` — queue driver (database or redis)
