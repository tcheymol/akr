# Setup

## Requirements

* PHP 8.1
* Symfony client [https://symfony.com/downloads](https://symfony.com/downloads)
* Postgresql
* Npm

## Database

* Install Psql
* Connect to postgres `psql`
* Create a db, user, and grant privileges

```postgresql
CREATE USER akr WITH PASSWORD 'akr';
CREATE DATABASE akr; GRANT ALL PRIVILEGES ON DATABASE "akr" to akr;
CREATE DATABASE akr_test; GRANT ALL PRIVILEGES ON DATABASE "akr_test" to akr;
```

* Run migrations

```bash
symfony console doctrine:migrations:migrate
```

## Run

```bash
symfony composer install
symfony serve
```

```bash
npm install
npm run dev
```

## Code quality standards
We use php-cs-fixer, rector, and phpstan
```bash
php ./vendor/bin/rector process
php ./vendor/bin/phpstan analyse
php ./vendor/bin/php-cs-fixer fix src --allow-risky=yes
php ./vendor/bin/php-cs-fixer fix tests --allow-risky=yes
# Or using Make
make rector
make stan
make lint
# Or running all at once
make cs
```