# Ticketing System

## Docker Setup

This project uses Docker for containerization. Below are the details of the services defined in the `docker-compose.yml` file.

### Services

- **app**: Runs the PHP application.
    - **Build Context**: `./backend`
    - **Dockerfile**: `Dockerfile`
    - **Container Name**: `laravel_app`
    - **Environment**:
        - `APP_ENV=local`
        - `DB_CONNECTION=mongodb`
    - **Volumes**:
        - `./backend:/var/www/html`
    - **Exposed Ports**: `9000`
    - **Depends on**: `mongo`

- **frontend**: Runs the Vue.js frontend application.
    - **Build Context**: `./frontend`
    - **Dockerfile**: `Dockerfile`
    - **Container Name**: `vue_frontend`
    - **Volumes**:
        - `./frontend:/app`
        - `/app/node_modules`
    - **Ports**: `3000:3000`
    - **Depends on**: `app`

- **mongo**: Runs the MongoDB database server.
    - **Image**: `mongo`
    - **Container Name**: `mongo_db`
    - **Environment**:
        - `MONGO_INITDB_ROOT_USERNAME=root`
        - `MONGO_INITDB_ROOT_PASSWORD=password`
    - **Volumes**:
        - `mongo_data:/data/db`
    - **Ports**: `27017:27017`

- **nginx**: Runs the Nginx web server.
    - **Image**: `nginx:latest`
    - **Ports**: `80:80`
    - **Volumes**:
        - `.:/var/www/html`
        - `./nginx/default.conf:/etc/nginx/conf.d/default.conf`
    - **Depends on**: `app`

### Getting Started

To get started with Docker, use the following commands:

1. Build the Docker containers:
   ```sh
   docker compose build

2. Access the Vue application:
    - **URL**: [http://localhost:3000](http://localhost:3000)

3. Access the Laravel application:
   - **URL**: [http://localhost/api](http://localhost/api)