# Laravel Travel Quotation API  Project Setup

This project was generated with [Laravel 12](https://laravel.com/) version 12.

A Laravel-based routes with RESTful API for managing your travel quotations with full CRUD operations.

Design pattern (MVC pattern): 
    UI -> Routes -> Controller -> Service -> Repository + Model 

Below steps will guide you through setting up and running the Laravel application.

## Development server

- If you dont have below requirment install, please install them first.
    - Normal setup
        Find ## Requirements mentioned here and install.

        # Installation

        ```bash
            # Clone the repository
            git clone from repository
            cd your_project_root (root)

            # Install PHP and npm dependencies
            composer install
            npm install

            # Create environment file
            cp .env.example .env
             cp .env.example .env.testing (update testing database credentials accordingly. refer: phpunit.xml)

            # Configure your .env file (DB connection, auth, mail, etc., )
            # Generate application key
            php artisan key:generate

            # Run database migrations
            php artisan migrate

            # (Optional) Seed the database
            php artisan db:seed

            # Start the development server
            php artisan serve
            npm run dev

            Navigate to `http://127.0.0.1:port`. The application will automatically reload with the source files.

    - Containerization 
         ```bash
            # Setup/install Docker 

            # Create `Dockerfile` for install php dependency and other configurations.

            # Create `docker-compose.yml` for create services like TaskMApiApp, TaskMworker (for queue/background process : send emails) and Mysql_db app.

            # Then run `docker-compose up -d` for create/ serve the containers. 



## 🚀 Features

- API/Route security - (X-APP-TOKEN).
- Clean architecture (Controller → Service Layer → Repository/Model).
- Well-structured JSON responses (Helpers response).
- Protected API routes.
- Database migrations and seeders.
- Notification handling for errors and success responses.
- Request data validations.
- Throttling route for security. 
- Centerlized exception handle in laravel 12 way.

## Requirements

- PHP ^8.2
- Laravel ^12
- Composer
- MySQL

## Tech Stack

- [Laravel-12] - php framework
- [Angular] - for frontend web app.
- [MaterialUI] - UI library for components.

## Future updates
- Add more test cases.
- User Auth/Register module and user/tenent.
- Improved UI versions.
- Delete and restore capabilities.


