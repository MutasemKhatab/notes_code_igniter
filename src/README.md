# Dockerized CodeIgniter (MySQL)

This repository contains a simple Docker setup for the CodeIgniter app.

Services:
- web: PHP 7.4 + Apache serving the CodeIgniter app (port 8080)
- db: MySQL 5.7 (port 3306)
- phpmyadmin: PhpMyAdmin (port 8081)

Quick start:

1. Copy or create a `.env` file next to `docker-compose.yml` with values (optional):

```env
DB_NAME=ci_db
DB_USER=ci_user
DB_PASS=ci_pass
MYSQL_ROOT_PASSWORD=rootpass
```

2. Build and run:

```bash
docker compose up --build
```

3. Open the app at http://localhost:8080
   PhpMyAdmin at http://localhost:8081 (user: `root`, password from `MYSQL_ROOT_PASSWORD`)

Notes:
- The app is mounted into the container, so changes on the host are reflected immediately.
- Ensure `application/cache` and `application/logs` are writable by the webserver (the entrypoint will attempt to chown them).
