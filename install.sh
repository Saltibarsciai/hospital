#docker-compose exec hospital composer install
#docker-compose exec hospital cp .env.example .env
docker-compose exec hospital npm install
docker-compose exec hospital npm run dev
docker-compose exec hospital php artisan key:generate
docker-compose exec hospital php artisan migrate:fresh
docker-compose exec hospital php artisan db:seed