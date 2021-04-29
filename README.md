## Installing

This application uses Laravel [Sail](https://laravel.com/docs/8.x/sail). 
Laravel Sail is a light-weight command-line interface for interacting with Laravel's default Docker development environment. 

To install application dependencies for the first time including Laravel sail
, run the following command from the application directory. 

```bash
docker run --rm \
      -u "$(id -u):$(id -g)" \
      -v $(pwd):/opt \
      -w /opt \
      laravelsail/php80-composer:latest \
      composer install --ignore-platform-reqs
```

## Starting & Stopping Sail

Laravel Sail's `docker-compose.yml` file defines a Docker variety of containers that work together to help you build Laravel applications. Each of these containers is an entry within the `services` configuration of your `docker-compose.yml` file. The `laravel.test` container is the primary application container that will be serving your application.

Before starting Sail, you should ensure that no other web servers or databases are running on your local computer. To start all of the Docker containers defined in your application's `docker-compose.yml` file, you should execute the `up` command:

```bash
sail up
```

To start all of the Docker containers in the background, you may start Sail in "detached" mode:

```bash
sail up -d
```

Once the application's containers have been started, you may access the project in your web browser at: http://localhost.

To stop all of the containers, you may simply press Control + C to stop the container's execution. Or, if the containers are running in the background, you may use the `down` command:

```bash
sail down
```
