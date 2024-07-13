# clone git
git clone ....

# up docker
docker-compose up --build -d

# run artisan migrate
docker exec -it laravel_app php artisan migrate:fresh --seed
