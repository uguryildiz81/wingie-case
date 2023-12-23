cp .env.example .env
docker-compose --env-file ./.env up -d
docker-compose exec app composer install
docker-compose exec app /var/www/html/artisan key:generate
docker-compose exec app php artisan migrate:reset
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan todo:providers
docker-compose exec app php artisan todo:developers
