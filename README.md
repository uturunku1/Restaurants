# Restaurants

#### Epicodus PHP Week 3, 3 Lab, 2/2017

#### By Stella Huayhuaca and Leah Sherrell

## Description

This lab is about experimenting with PHP and installing the silex and Twig frameworks and extending to mySQL.

## Setup/Installation Requirements
* See https://secure.php.net/ for details on installing _PHP_.  Note: PHP is typically already installed on Mac.
* See https://getcomposer.org/ for details on installing _composer_.
* See https://mamp.info/ for details on installing _MAMP_.
* Use MAMP `http://localhost:8888/phpmyadmin/` and `to_do.sql.zip` to import a `to_do` database.
* Use same MAMP website to copy to_do database to `to_do_test` database (if you would like to try PHPUnit tests).
* Use MAMP
* Clone project
* From project root, run > `composer install --prefer-source --no-interaction`
* To run PHPUnit tests from root > `vendor/bin/phpunit tests`
* From web folder in project, Start PHP > `php -S localhost:8000`
* In web browser open `localhost:8000`

## Known Bugs
* No known bugs

## Support and contact details
* No support

## Technologies Used
* PHP
* MAMP
* mySQL
* Composer
* PHPUnit
* Silex
* Twig
* HTML
* CSS
* Bootstrap
* Git

## Copyright (c)
* 2017 Stella Huayhuaca and Leah Sherrell

## License
* MIT

## Specifications
* Start MySQL.
* Start phpunit dependency.
* Create the database with tables and columns.
* Create Restaurant Class with name, cuisine_id.
* Create Cuisine Class with type.
* Test for functionality.
* Build class methods according to tests.
* Silex and Twig Dependencies
* Initial Silex framework
* Add classes functionality to routes.
* Twig forms


|Behavior|Input|Output|
|--------|-----|------|
|Cuisine created|the user inputs a cuisine type |Shows type of cuisine the user just created in a list.|
|Cuisine type selected|Selected cuisine |Shows new page where they can start adding restaurants.|
|Restaurant created|The user inputs a restaurant for that type of cuisine|list the new restaurant in the same page.|
|Delete specific restaurant|restaurant deleted|one less restaurant|


* End specifications
