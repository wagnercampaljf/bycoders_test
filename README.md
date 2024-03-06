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

1. Access the app:

    ```bash
    http://localhost/
    ```



## Useful Laravel Sail Commands

- Start Docker containers:

    ```bash
    ./vendor/bin/sail up
    ```

- Stop Docker containers:

    ```bash
    ./vendor/bin/sail down
    ```

## Desciption

- I used Laravel Sail (Docker) for the portability of the necessary technologies.
- For the trial, a registry of TASKs was created, with a CRUD with filter pair and all CRUD functionalities.
- A Dahboard was also created to view summarized Task data, as well as a filter for the Dashboard table and graphs.
- For the login part, Jetstream was used, creating a complete system for login, profile, reset password, etc.
- Broadcasting made using Laravel Echo and Pusher, to test it is recommended to open two tabs, or two browsers, in one tab leave the Dashboard open to see the changes, and in the other tab open the Tasks register and register a new Task, notice that Broadcasting updates the Dashboard in real time.

## Main Tools Used

- Laravel Sail
- Livewire
- Bootstrap
- Jetstream
- Pusher & Laravel Echo (Broadcasting)
- MySQL
