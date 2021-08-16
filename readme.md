# Cricket Team Management

💥 **It is a simple team management system developed using bootstrap4, Additionally used Noty.js for notification's.** 💥

## Installation

Use composer to install the package:

```bash
composer install
```

## Configuration

To configure the package you need to publish settings first

```
1. Duplicate/Copy .env.example & rename the other file to .env
2. Change the DB connection values in .env file
```

Then, Run the following commands

```
php artisan key:generate
php artisan migrate
```

> **NOTE:** Give permission to storage folder for uploading the images

Now start the laravel server through localhost

```
php artisan serve
```

## Requirements

The package has been tested in the following configuration:

- PHP version &gt;=7.1.3, &lt;=7.4.22
