# About application
- Service for purchase currencies (EUR,GBP,JPY) with USD

## Technologies

- Laravel v.7.0
- Jquery v.3.4.1

### Installation:

- git clone https://github.com/Uros92/Menu_app.git
- cd Menu_app/
- Make copy of file from root project .env.example and rename it to **.env** and paste to root of project: **cp .env.example .env**
- Composer install
- Start xampp or wamp server
- Open localhost/phpmyadmin and create database **menu_app**
- Open terminal in root project and call next command **php artisan migrate --seed**
- Then next command: **php artisan serve**
- Open application i browser **http://127.0.0.1:8000**

### Update currencies exchange rates via api by terminal command or via cron job
- Open terminal in root project and call next command: **php artisan schedule:run**
- Or let cron job to do that daily at 08:00am

### Tests
- Test api http://api.currencylayer.com/ if everything is ok
- **php artisan test**


![image description](https://github.com/Uros92/Menu_app/blob/master/app_diagram.png)
