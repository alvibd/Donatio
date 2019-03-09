Donatio
-----------------

Easy Installation
-----------------
**Requirements**
- Apache server
- php>=7
- Postgres\mysql
- composer

**Steps**
- Clone this repository: `$ git clone https://github.com/alvibd/Donatio.git`
- cd to project directory: `$ cd Donatio`
- checkout to dev branch: `$ git checkout -b dev`
- pull latest dev: `$ git pull origin dev`
- create _.env_: `$ cp .env.example .env`
- set database configurations in _.env_
- install all the requirements: `$ composer install`
- generate key: `$ php artisan key:generate`
- create all the tables: `$ php artisan migrate`
- run database seed: `$ php artisan db:seed`
- create local storage : `$ php artisan storage:link`
- run `$ php artisan serve` enjoy start the server and enjoy
- create a virtual host to get the best experience
