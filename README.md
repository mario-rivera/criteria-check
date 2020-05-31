## Starting the application

```bash
docker-compose up -d webserver
```

## Criteria Endpoint

```bash
curl --location --request GET 'http://localhost/check/?city=paris'
```

```bash
curl --location --request GET 'http://localhost/check/?city=taipei'
```

## Running Unit Tests

```bash
docker-compose \
-f $(pwd)/docker/services/php.yml --project-directory $(pwd) \
run --rm --no-deps \
phpunit
```

### ** I did NOT test all of the classes I created for this test

## Criteria Config and Reordering

- Criteria can be easily configured from config/services.yaml
- Each criteria is a class implementing WeatherCriterionInterface
- Criteria can accept logical operators AND and OR