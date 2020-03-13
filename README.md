# About application
- Service for purchase currencies (EUR,GBP,JPY) with USD

## Technologies

- Laravel v.7.0
- Jquery v.3.4.1

### Installation:

- git clone https://github.com/Uros92/Menu_app.git
- Make copy of file from root project .env.example and rename it to **.env** and paste to root of project: **cp .env.example .env**
- Composer install
- Start xampp or wamp server
- Open localhost/phpmyadmin and create database **menu_app**
- Open terminal in root project and call next command **php artisan migrate --seed**
- Then next command: **php artisan serve**

### Update currencies exchange rates via api
- Open terminal in root project and call next command: **php artisan schedule:run**

### Tests
- Test api http://api.currencylayer.com/ if everything is ok
- **php artisan test**


![image description](https://github.com/Uros92/Menu_app/blob/master/app_diagram.png)
