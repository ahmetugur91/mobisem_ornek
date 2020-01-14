## Install

When you clone or download the project, execute commands below.

- composer install
- cp .env.example .env
- set the database connection informations into .env file
- php artisan migrate
- php artisan db:seed (create sample data into database)
- php artisan key:generate
- php artisan serve

## Directory Info

- Controllers => app/Http/Controllers/
- Request Validations => app/Http/Requests/
- Policies => app/Policies/
- Factories => database/factories/
- Seeds => database/seeds/
- Migrations => database/migrations/
- Resources (Blade templates) => resources/views/
- Routes => routes/web.php

## Entity Relationship Diagram
<p align="center">
<a href="https://i.hizliresim.com/00OV3B.png" target="_blank">
<img src="https://i.hizliresim.com/00OV3B.png" width="400">
</a>
</p>