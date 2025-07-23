# Laravel Travel Quotation API  Project Setup

This guide walks you through setting up and running the Laravel application.

## 📦 Clone the Repository

```bash
git clone [repository]
cd / the app directory.

## 📦 Install PHP dependencies:

composer install

Copy the example environment file and generate an application key:

cp .env.example .env
php artisan key:generate

Update the `.env` file with your database credentials:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=your_database  
DB_USERNAME=your_username  
DB_PASSWORD=your_password  

## 📦 Run database migrations and seeders:

php artisan migrate --seed


## 📦Start the development server:

php artisan serve

Visit the application in your browser at:  
http://localhost:8000

You're all set!
(Find the user credentials from DatabaseSeeder)
