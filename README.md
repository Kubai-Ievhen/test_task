### Requirements

 + Apache
 + PHP >= 7.1.3
 + MySQL >= 5.7.0
 + Composer
 
### Installation

 + Create MySQL database
 + Run `cp .env.example .env`
 + Configure database parameters in  `.env`
 + Run `composer install`
 + Run `php artisan key:generate`
 + Run `php artisan migrate`