# Laravel 12 Project

This is a Laravel 12 application.

## Requirements

- PHP = 8.2
- Composer
- MySQL or another supported database


## Installation

1. **Copy this to /var/www/html folder**
   ```bash
   git clone https://github.com/your-username/your-laravel-project.git
   cd your-laravel-project

2. **Update the composer**
    ```bash
    php composer.phar update

    or

    ```bash
    composer update

3. **Databse**
    ```bash
    php artisan migrate

    or

    use the test_contact.sql file -> import -> use in .env

4. **If there is any permission issue then just change it like below for the project**
    **Laravel Project Permissions**
    ```bash
    sudo find ./ -type f -exec chmod 644 {} \;
    sudo find ./ -type d -exec chmod 755 {} \;
    sudo chown -R jack:jack ./
    sudo chown -R www-data:www-data ./storage/

5. **Ready to Use**

