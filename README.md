prosess to run the app:

1. clone this repo to your local machine: `https://github.com/Red9112/e_commerce_web_app.git && cd e_commerce_web_app`
1. copy `.example.env` to `.env` file: `cp .example.env .env`
1. create a new database and add the database credentials to your `.env` file
1. run `composer install`
1. run `npm install && npm run dev`
1. run `php artisan serve` and then visit `http://127.0.0.1:8000/`
1. credentials to access admin panel (email: ``, password: `password`)
1. create the storage racourcie after delete storage folder in public: `php artisan storage:link`








