# LetraMundo Back

## Requirements

- [Docker](https://www.docker.com/) (recommended)
- Or: PHP 8.2+, Composer, MySQL

## Running with Docker

1. Copy the example environment file:
   ```sh
   cp .env.example .env
   ```

2. Edit the `volumes` section in your `docker-compose.yml` file. Replace `./your-local-folder` with the path you want to use on your machine.
    ```yaml
    services:
    app:
        volumes:
        - ./your-local-folder:/app
    ```

3. Start the containers:
   ```sh
   docker-compose up -d
   ```

4. Install dependencies and generate the application key (inside the container):
   ```sh
   docker exec -it letramundo_back bash
   composer install
   php artisan key:generate
   php artisan migrate --seed
   exit
   ```

5. Access the app at [http://localhost:8080](http://localhost:8080).

6. Access phpMyAdmin at [http://localhost:9090](http://localhost:9090)

## Running Manually (without Docker)

1. Install dependencies:
   ```sh
   composer install
   ```

2. Copy the example environment file and set your DB credentials:
   ```sh
   cp .env.example .env
   ```

3. Generate the application key:
   ```sh
   php artisan key:generate
   ```

4. Run migrations and seeders:
   ```sh
   php artisan migrate --seed
   ```

5. Start the development server:
   ```sh
   php artisan serve
   ```

6. The app will be available at [http://localhost:8000](http://localhost:8000).

## Running Tests

```sh
php artisan test
```
or
```sh
./vendor/bin/phpunit
```

## API Documentation

After starting the app, visit [http://localhost:8080/api/documentation](http://localhost:8080/api/documentation) for Swagger UI.