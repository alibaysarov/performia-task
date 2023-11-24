## Docker Сборка (Laravel- React) 
## Состав сборки
- php-fpm
- mysql
- nginx
- artisan
- composer

node.js нужно установить локально
### Инструкция
- Склонировать репозиторий
- **docker-compose run composer create-project laravel/laravel .**
- заполнить env для подключнеия к бд в ./src/.env и в env/mysql.env (в DB_HOST указать название сервиса)
- создать сеть **docker network create laravel_react_app**
- docker-compose up -d
- docker-compose run artisan migrate (для миграций)
