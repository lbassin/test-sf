# Start project
```bash
cp .env.dist .env
docker-compose up -d
docker-compose exec php-fpm bin/console doctrine:schema:update --force
```

# Run tests
```bash
docker-compose run phpunit
```