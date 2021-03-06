# Otravo WordPress exercise

## Task description

Create a REST API endpoint which will return a list of airports for specified IATA city code.
You may try to reuse [WordPress REST API](https://developer.wordpress.org/rest-api/) or create your own.

So when calling an url like `http://otravo.exercise/api/airports/LON` it should return content with a such structure (where LON is cityCode):
```json
[
    {
        "code": "LCY",
        "name": "London City",
        "cityCode": "LON",
        "countryCode": "GB",
        "continentCode": "EU"
    },
    {
        "code": "LGW",
        "name": "Gatwick",
        "cityCode": "LON",
        "countryCode": "GB",
        "continentCode": "EU"
    }
]
```

Store **locations** in a custom database table:
- location (airport and city) IATA code always consists of 3 latin (A-Z) letter,
- location name may consist of up to 200 UTF-8 characters,
- country IATA code always consists of 2 latin letter,
- continent IATA code always consists of 2 latin letter.

Table structure can be provided as a separate SQL file or handled with migrations functionality.

Implement a simple way (url endpoint or cronjob or something else) to update this custom table.
Use [data/airports.json](data/airports.json) file as a source.

You are allowed to include and use external libraries.

Use `Redis` cache were appropriate.
If using Docker-Compose, `redis` service is already provided and it's hostname is stored in `REDIS_HOST` environment variable.

## Origins

The application for this exercise is created from [Bedrock](https://roots.io/bedrock/) -
a modern WordPress stack that helps you get started with the best development tools and project structure.

## Requisite tools

* [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) -
  dependency management tool in PHP.

## Recommended tools

* Docker 17.12.0+ with [Docker-Compose](https://docs.docker.com/compose/install/) -
  helps to load and connect the needed application services (PHP, Nginx, MySQL) without conflicting with versions on local (host) machine.

## Installation

1. Install PHP dependencies with `composer install` command.
2. Copy **.env.example** file as **.env** and update environment variables there:
    * Database variables
        * `DB_NAME` - Database name (`otravo_test` - pick anything you want),
        * `DB_USER` - Database user (`root` - no need to change if using Docker-Compose),
        * `DB_PASSWORD` - Database password (may want to generate your own),
        * `DB_HOST` - Database host (`mysql` - no need to change if using Docker-Compose),
        * Optionally, you can define `DATABASE_URL` for using a DSN instead of using the variables above (e.g. `mysql://user:password@127.0.0.1:3306/db_name`),
    * `WP_ENV` - Set to environment (`development` - keep this, `staging`, `production`),
    * `WP_HOME` - Full URL to WordPress home (`http://otravo.exercise` - pick anything you want),
    * `REDIS_HOST` - hostname for `redis` service (`redis` - no need to change if using Docker-Compose),
    * `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
        * Generate with [our WordPress salts generator](https://roots.io/salts.html) - recommended, as no additional tools are needed.
        * Generate with [wp-cli-dotenv-command](https://github.com/aaemnnosttv/wp-cli-dotenv-command).
3. Launch the application.
    * **Method 1 (recommended):**
        - add `127.0.0.1 otravo.exercise` to your local **hosts** file, like **/etc/hosts**,
        - execute `docker-compose up -d` in project root directory.
    * **Method 2:** set the document root on your webserver to Bedrock's `web` folder: `/path/to/site/web/` and restart the server.
4. Access WordPress admin at `http://otravo.exercise:3333/wp/wp-admin/` (depends on chosen `WP_HOME` value). Database is accessible on 3336 port on localhost by default.
5. Create user and install WordPress.


## Delivery

Fork otravobv/wp-exercise, make your changes and create pull request to otravobv/wp-exercise
