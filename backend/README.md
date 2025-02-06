<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Details

### Laravel Version

This project is built using **Laravel 11.x**.

### Routes

The following routes are available in this project:

- **GET /tickets**: Display a list of tickets.
- **POST /tickets**: Create a new ticket.
- **GET /tickets/{id}**: Display a specific ticket.
- **PUT /tickets/{id}**: Update a specific ticket.
- **DELETE /tickets/{id}**: Delete a specific ticket.

### Authentication APIs

The following authentication APIs are available in this project:

- **POST /auth/register**: Register a new user.
- **POST /auth/login**: Log in a user.
- **POST /auth/logout**: Log out the authenticated user.
- **GET /auth/user**: Get the authenticated user's details.

### Docker

This project uses Docker for containerization. The Docker setup includes:

- **PHP**: The application runs on PHP 8.x.
- **Nginx**: Nginx is used as the web server.
- **MongoDB**: MongoDB is used as the database server.

