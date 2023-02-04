### For run project follow the instruction below

Clone the repository

```git clone https://github.com/kriptogenic/credo-test.git```

Copy .env file and fill DB credentials

`cp .env.example .env`

Install composer dependencies

`composer install`

Generate key with artisan command

`php artisan key:generate`

Run migrations

`php artisan migrate`

Run database seeder

`php artisan db:seed`

Run project

`php artisan serve`

Open http://localhost:8000
