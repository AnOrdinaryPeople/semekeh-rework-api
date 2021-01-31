# SMK Rework Splitted Version for API

## Requirements
- [Composer](https://getcomposer.org/download) >= 2.0.7
- PHP >= 7.3
- Mysql >= 15.1 Distrib 10.4.11-MariaDB

## Setup
### PHP Config
find `php.ini` and edit these:
```
memory_limit=-1
upload_max_filesize=1000M
post_max_size=1000M
```

### Google Recaptcha
Can be obtained at [Google Recaptcha](https://www.google.com/recaptcha/admin)
- Recaptcha version 2
- domain `localhost` and `127.0.0.1`

### Install
```bash
# duplicate environment
$ cp .env.example .env

# setup environment
# APP_URL=http://localhost:8000
# FE_URL=http://localhost:3000
# DB_DATABASE=db_smk_rework
# RECAPTCHA_SITE_KEY=YOUR_RECAPTCHA_SITE_KEY
# RECAPTCHA_SECRET=YOUR_RECAPTCHA_SECRET_KEY

# install dependencies
$ composer install

# run migrate and seeder command
$ php artisan migrate --seed

# Generate secret key
$ php artisan jwt:secret

# serve
$ php -S localhost:8000 -t public
```
