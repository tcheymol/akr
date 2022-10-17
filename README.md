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
CREATE DATABASE akr;
GRANT ALL PRIVILEGES ON DATABASE "akr" to akr;
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
