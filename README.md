# ETS PBKK 2022
## How to run
1. Make sure you have php and composer installed
1. Copy `.env.example` to `.env`
1. Set environment variable related to connection to database and AWS S3 bucket in .env
1. Run `composer install`
1. Run `php artisan key:generate`
1. Run `php artisan migrate --seed`
1. Run `php artisan serve`
