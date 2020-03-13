# Service for purchase currencies

## Technologies

- Laravel v.7.0
- Jquery v.3.4.1

### Instalation:

- git pull https://github.com/Uros92/Menu_app.git
- make copy of file from root project .env.example and rename it to .env
- composer install
- start xamp or wamp server
- open localhost/phpmyadmin and create database "menu_app"
- open terminal in root project and call next command "php artisan migrate --seed"
- then next command "php artisan serve"

#### Update currencies exchange rates via api
- open terminal in root project and call next command "php artisan schedule:run"
