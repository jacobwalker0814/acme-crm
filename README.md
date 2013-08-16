Acme Company CRM
===================================

## About

This application was developed as part of a job interview development test. It is a Customer Relationship Management system that allows you to manage a list of contacts. It uses an Active Record class `\Acme\CRM\Models\AbstractModel` built to the test's spec. The application logic is handled in the [Bullet PHP Microframework](http://bulletphp.com). The front end uses [HTML5 Boilerplat](http://html5boilerplate.com/) and [Twitter Bootstrap](http://getbootstrap.com/2.3.2/).

## Requirements

* Requires PHP >= 5.3
* Apache with mod_rewrite

## Installation

### Install Dependencies

Install Composer if necessary

    curl -sS https://getcomposer.org/installer | php

Run composer install

    php -f composer.phar install

### Configure Database

Copy the file `config/config.example.ini` to `config/config.ini` then change the database connection credentials.

Create a database matching what you specified in the configuration file and grant the appropriate permissions. For example you might run:

    CREATE DATABASE acme_crm;
    GRANT ALL ON acme_crm.* TO 'acme_user'@localhost IDENTIFIED BY 'acme_password';

Next source the file `app/config/contacts.sql` into the new database.

### Configure Apache

Set up a host with the project root as the DocumentRoot with Options enabled so the `.htaccess` can perform the mod_rewrite rules.
