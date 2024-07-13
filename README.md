# clone git
- git clone https://github.com/masdudung/digilib

# setup .env
- This example has been adapted to run in docker
- just copy .env.example to .env

# up docker
- docker-compose up --build -d

# run artisan migrate
- docker exec -it laravel_app php artisan migrate:fresh --seed

# run test
- docker exec -it laravel_app php artisan test

# API DOC
Import this file into postman
- Authors.postman_collection.json
- Books.postman_collection.json