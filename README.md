
Getting started

Installation

Please check the official laravel installation guide for server requirements before you start. Official Documentation

Clone the repository

git clone https://github.com/rjgithub123/machine-test.git
Switch to the repo folder

cd machine-test
Install all the dependencies using composer

composer install
Copy the example env file and make the required configuration changes in the .env file

cp .env.example .env
Generate a new application key

The database file added in the db folder.Plesae import that into your local env.

php artisan key:generate
Generate a new JWT authentication secret key

php artisan migrate
Start the local development server

php artisan serve
You can now access the server at http://localhost:8000

