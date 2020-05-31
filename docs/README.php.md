# Run Unit Tests
From the root of this package execute the following command:

```bash
$ docker-compose \
-f $(pwd)/docker/services/php.yml --project-directory $(pwd) \
run --rm --no-deps \
phpunit
```