# DIGILIB
simple RESTful API for a library management system

## Live API Endpoint
Access the API endpoint at following link:
[Books API](https://api-digilib.moveidn.com/api/v1/books?page=1&limit=10)
[Authors API](https://api-digilib.moveidn.com/api/v1/authors?page=1&limit=10)

Simple Test Result https://bit.ly/3VVFrGQ


## How To Install
Assume we use docker, make sure it has been installed on your computer

- **Clone Git Repository**

    `git clone https://github.com/masdudung/digilib`

- **Setup Environment**

    Copy `.env.example` to `.env` to configure environment variables.  

- **Docker Setup** 

    Build and start the Docker containers: ```docker-compose up --build -d ```

- **Prepare Databases**

    Run database migrations and seed data

    `docker exec -it laravel_app php artisan migrate:fresh --seed`

- **Running Tests**
    
    `docker exec -it laravel_app php artisan test`

- **ANY ERROR?**
    
    Sometime package predis cannot be found, reinstall with:

    `docker exec -it laravel_app composer require predis/predis`

## API DOC
Import this file into postman (check root repository) 
- Authors.postman_collection.json
- Books.postman_collection.json

## Optimize Option
- Optimize with indexing table **(done)**
- Optimize query with cache **(done)**
- Add rate limiter to prevent overload **(done)**
- Separate database for read and write, add more read replica **(actually i never do this)**
- Use load balancer **(actually i never setting by myself)**
- Consider use queue for heavy process **(usually i use RabbitMQ)**
- Consider use **cursor pagination**
- Use application profiling / monitoring to debug and optimize code **(Sentry / NewRelic)**

## Design Choices
- `Repository Pattern:`

    By using the repository pattern, we separate the data access logic from the business logic. This makes the codebase more modular, easier to maintain, and testable.

    Common data access methods are centralized in the repository, so we can make code reusable.

- `Redis Caching:`

    By caching the results, subsequent requests for the same data can be served quickly from the cache, reducing the load on the database.

    A unique cache key is generated based on the query string to ensure that different queries are cached separately

- `Indexing:`

    Indexes are added to columns that are frequently used in search and sort operations (name, title, birthdate and publish_date). Indexes allow the database to quickly locate and retrieve the data.

- `Rate Limiting:`
    Rate limiting is implemented to prevent abuse and ensure fair usage of the API. Curently set 50 request perminute by ip address (too small i think)

- `Pagination:`

    Pagination is used to limit the number of records retrieved in a single query. This prevents the application from loading too much data into memory at once.
    Curently use offset based pagination

- `Select only necessary columns:`

    Select only the necessary columns to reduce the amount of data transferred from the database to the application.