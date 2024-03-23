

# Laravel Starter (based on Laravel 10.x)
**Laravel Starter** is a Laravel 10.x based simple starter project. Most of the commonly needed features of an application like `Authentication`, `Authorisation`, `User` and `Role management`, `Application Backend`, `Backup`, `Log viewer` are available here. It is modular, so you may use this project as a base and build your own modules. A module can be used in any `Laravel Starter` based projects. 

Please let me know your feedback and comments.

# Reporting a Vulnerability
If you discover any security-related issues, please send an e-mail to WebNDevs via webndevs@gmail.com instead of using the issue tracker.

# Appplication Demo
Check the following demo project. It is just a straight installation of the project without any modification.


You may use the following account credentials to access the application backend. 

```
User: super@admin.com
Pass: secret
  `
User: user@user.com
Pass: secret

```

## Demo Data
If you want to test the application on your local machine with additional demo data you may use the following command. 

```php

php artisan starter:insert-demo-data --fresh

```

There are options to truncate the `posts, categories, tags, and comments` tables and insert new demo data.

`--fresh` option will truncate the tables, without this command new set of data will be inserted.

```php

php artisan starter:insert-demo-data --fresh

```

# Custom Commands

We have created a number of custom commands for the project. The commands are listed below with a brief about their use of it.

## Create New module

To create a project use the following command, you have repalce the MODULE_NAME with the name of the module.

```php
php artisan module:build MODULE_NAME
```

You may want to use `--force` option to overwrite the existing module. if you use this option, it will replace all the exisitng files with the defalut stub files.

```php
php artisan module:build MODULE_NAME --force
```

## Clear All Cache

```bash
composer clear-all
```

this is a shortcut command clear all cache including config, route, and more

## Code Style Fix

We are now using `Laravel Pint` to make the code style stays clean and consistent as the Laravel Framework. Use the following command to apply CS-Fix. 

```bash
composer pint
```

## Role - Permissiosn

Several custom commands are available to add and update `role-permissions`. Please read the [Role - Permission Wiki page](https://github.com/laravel-starter/wiki/Role-Permission), where you will find the list of commands with examples. 


# Features

The `Laravel Starter` comes with several features which are the most common in almost all applications. It is a template project which means it is intended to build in a way that it can be used for other projects.

It is a modular application, and some modules are installed by default. It will be helpful to use it as a base for future applications.

* Admin feature and public views are completely separated as `Backend` and `Frontend` namespace.
* Major features are developed as `Modules`. A module like Posts, Comments, and Tags are separated from the core features like User, Role, Permission


## Core Features

* User Authentication
* Social Login
  * Google
  * Facebook
  * Github
  * Build in a way adding more is much easy now
* User Profile with Avatar
  * Separate User Profile table
* Role-Permissions for Users
* Dynamic Menu System
* Language Switcher
* Localization enabled across the project
* Backend Theme
  * Bootstrap 5, CoreUI
  * Fontawesome 6
* Frontend Theme
  * Tailwind
  * Fontawesome 6
* Article Module
  * Posts
  * Categories
  * Tags
  * Comments
  * wysiwyg editor
  * File browser
* Application Settings
* External Libraries
  * Bootstrap 5
  * Fontawesome 6
  * CoreUI
  * Tailwind
  * Datatables
  * Select2
  * Date Time Picker
* Backup (Source, Files, Database as Zip)
* Log Viewer
* Notification
  * Dashboard and details view


# User Guide

## Installation

Follow the steps mentioned below to install and run the project. You may find more details about the installation.

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `php artisan migrate --seed`
6. Link storage directory: `php artisan storage:link`
7. You may create a virtualhost entry to access the application or run `php artisan serve` from the project root and visit `http://127.0.0.1:8000`

*After creating the new permissions use the following commands to update cashed permissions.*

`php artisan cache:forget spatie.permission.cache`

## Docker and Laravel Sail
This project is configured with Laravel Sail (https://laravel.com/docs/sail). You can use all the docker functionalities here.

## Icons
FontAwesome & CoreUI Icons, two different font icon library is installed for the Backend theme and only FontAwesome for the Frontend. For both of the cases, we used the free version. You may install the pro version separately for your project.

* **FontAwesome** - https://fontawesome.com
* **CoreUI Icons** - https://icons.coreui.io/icons/


