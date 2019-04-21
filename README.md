## Starting the application

```bash
$ docker-compose up -d
```

## Generate Swagger Documentation (YAML)

```bash
$ docker-compose -f $(pwd)/docker/services/commands.yaml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
docs
```

## Running composer install

```bash
$ docker-compose -f $(pwd)/docker/services/commands.yaml \
--project-directory $(pwd) \
run --rm --no-deps --user $(id -u):$(id -g) \
composer
```

## Overloading Xdebug configuration

```bash
$ docker cp {xdebug.config.ini} {container}:/usr/local/etc/php/conf.d/xdebug.config.ini \
&& docker restart {container}
```

<!-- ## Run Swagger UI

```bash
$ docker-compose -f $(pwd)/docker/services/commands.yaml \
--project-directory $(pwd) \
run -d --service-ports --name swaggerui \
swaggerui
``` -->