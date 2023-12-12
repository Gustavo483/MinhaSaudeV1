<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Passo-a-passo - Instalação do projeto
0. Relize a instalação do php 8.2 em seu computador.
1. Em sua pasta raiz, clone o arquivo do projeto usando **git clone** https://github.com/Gustavo483/MinhaSaudeV1.git
2. Verifique se o Composer está instalado em seu sistema. Se você não tiver o Composer instalado, acesse o site oficial do Composer (https://getcomposer.org/) e siga as instruções de instalação adequadas para o seu sistema operacional.
3. Abra a pasta do projeto em seu terminal e execute o comando:

```sh
composer install
```

4. Na pasta do projeto, crie um arquivo `.env`, no escopo do projeto existe um arquivo chamado `.env.example` onde basta renomea-lo para `.env`. Após isso gere a chave para este projeto usando o comando:

```sh
php artisan key:generate
```


5. No arquivo `.env` que foi criado, estabeleça a conexão com seu banco de dados mysql:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NAMEDB
DB_USERNAME=DB_USERNAME
DB_PASSWORD=DB_PASSWORD
```

6. Após realizar a configuração com seu banco de dados, execute o comando :

```sh
php artisan migrate
```

7. Por fim, execute o comando abaixo para iniciar o projeto e click no link que será aberto no seu terminal. 
```sh
php artisan serve
```
