## Тестовое задание
### Docker Сборка (Laravel- React) 
### Состав сборки
- php-fpm
- mysql
- nginx
- artisan
- composer
### Инструкция
- Склонировать репозиторий
- **docker-compose run composer create-project laravel/laravel .**
- заполнить env для подключнеия к бд в ./src/.env и в env/mysql.env (в DB_HOST указать название сервиса)
- создать сеть **docker network create performia-test**
- docker-compose up -d
- docker-compose run artisan migrate (для миграций)
- сделать сидер на 10 элементов (php artisan db:seed --class=TodoSeeder)
- запустить из командной строки npm run dev (localhost:8000)