# Laravel Sail Setup

Este repositório contém um projeto Laravel configurado para uso com Laravel Sail.

## Pré-requisitos

- Composer
- Docker
- Docker Compose

## Instalação e Configuração

1. Navegue até o diretório do projeto:

    ```bash
    cd seu-projeto
    ```

2. Instale as dependências do Composer:

    ```bash
    composer install
    ```

3. Inicie os contêineres Docker usando Sail:

    ```bash
    ./vendor/bin/sail up
    ```

4. Instale as dependências do npm (opcional, se você estiver usando JavaScript):

    ```bash
    ./vendor/bin/sail npm install
    ```

5. Compile os assets usando npm (opcional, se você estiver usando JavaScript):

    ```bash
    ./vendor/bin/sail npm run build
    ```

6. Execute as migrações do banco de dados:

    ```bash
    ./vendor/bin/sail php artisan migrate
    ```

7. Se necessário, execute os seeds do banco de dados:

    ```bash
    ./vendor/bin/sail php artisan db:seed
    ```

## Uso

Após concluir a instalação e configuração, você pode começar a usar seu aplicativo Laravel.

## Comandos Úteis do Laravel Sail

- Iniciar os contêineres Docker:

    ```bash
    ./vendor/bin/sail up
    ```

- Parar os contêineres Docker:

    ```bash
    ./vendor/bin/sail down
    ```

## Principais ferramenas utilizadas

- Laravel Sail
- Livewire
- Boostatrap
- Jetstream
- Pusher & Laravel Echo (Broadcasting)
- MySQL