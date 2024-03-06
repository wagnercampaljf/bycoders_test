# Laravel Sail Setup

Este repositório contém um projeto Laravel configurado para uso com Laravel Sail.

## Pré-requisitos

- Docker
- Docker Compose

## Instalação e Configuração

1. Clone o repositório:

    ```bash
    git clone https://github.com/seu-usuario/seu-projeto.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd seu-projeto
    ```

3. Instale as dependências do Composer:

    ```bash
    composer install
    ```

4. Inicie os contêineres Docker usando Sail:

    ```bash
    ./vendor/bin/sail up
    ```

5. Instale as dependências do npm (opcional, se você estiver usando JavaScript):

    ```bash
    ./vendor/bin/sail npm install
    ```

6. Compile os assets usando npm (opcional, se você estiver usando JavaScript):

    ```bash
    ./vendor/bin/sail npm run build
    ```

7. Execute as migrações do banco de dados:

    ```bash
    ./vendor/bin/sail php artisan migrate
    ```

8. Se necessário, execute os seeds do banco de dados:

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

- Executar comandos Artisan:

    ```bash
    ./vendor/bin/sail artisan [comando]
    ```

- Executar comandos Composer:

    ```bash
    ./vendor/bin/sail composer [comando]
    ```

- Executar comandos npm/yarn:

    ```bash
    ./vendor/bin/sail npm [comando]
    ```

## Documentação

Para obter mais informações sobre como usar o Laravel Sail, consulte a [documentação oficial do Laravel](https://laravel.com/docs/8.x/sail).

