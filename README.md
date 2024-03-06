# Laravel Sail Setup

This repository contains a Laravel project configured for use with Laravel Sail.

## Prerequisites

- Composer
- Docker
- Docker Compose

## Installation and Configuration

1. Navigate to the project directory:

    ```bash
    cd your-project
    ```

2. Install Composer dependencies:

    ```bash
    composer install
    ```

3. Start Docker containers using Sail:

    ```bash
    ./vendor/bin/sail up
    ```

4. Install npm dependencies (optional, if you're using JavaScript):

    ```bash
    ./vendor/bin/sail npm install
    ```

5. Compile assets using npm (optional, if you're using JavaScript):

    ```bash
    ./vendor/bin/sail npm run build
    ```

6. Run database migrations:

    ```bash
    ./vendor/bin/sail php artisan migrate
    ```

7. If needed, run database seeds:

    ```bash
    ./vendor/bin/sail php artisan db:seed
    ```

## Usage

After completing installation and configuration, you can start using your Laravel application.

## Useful Laravel Sail Commands

- Start Docker containers:

    ```bash
    ./vendor/bin/sail up
    ```

- Stop Docker containers:

    ```bash
    ./vendor/bin/sail down
    ```

## Main Tools Used

- Laravel Sail
- Livewire
- Bootstrap
- Jetstream
- Pusher & Laravel Echo (Broadcasting)
- MySQL
