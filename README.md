# Todo App in Laravel

# Technology used

1. PHP
2. Laravel
3. Typescript
4. Vue 3

# How to run the application

## Install dependencies and set up environment files

```sh
composer install

npm install

cp .env.example .env

php artisan key:generate

cp .env .env.testing
```

Inside `.env` and `.env.testing` files, change the following variables as
appropriate (only `FORWARD_DB_PORT` is important in `.env.testing`):

```
APP_PORT=
FORWARD_BROWSER_SYNC_PORT=
FORWARD_BROWSER_SYNC_UI_PORT=
FORWARD_DB_PORT=
```

Visit `http://localhost:$APP_PORT` to see your app.

## Build and run the docker containers/migrate database

```sh
./vendor/bin/sail up mysql laravel.test
./vendor/bin/sail artisan migrate --seed
```

## Run browser sync to watch and reload files on changes

```sh
./vendor/bin/sail npm run dev
./vendor/bin/sail npm run watch
```

Visit `http://localhost:$FORWARD_BROWSER_SYNC_PORT` to see your app and
reload files on changes.

# Testing, linting, type-checking, prettify

There are various commands you can run. Discover commands by running:

```sh
npm run nps
```

## Examples:

### PHP

I was not able to get laravel to run database tests inside transactions, so we
need to set up a database, different from our normal app database, to run tests
in. This is because laravel will clean out the database for each test run.

First, you need to source the `.env.testing` file in your shell.
If your shell is bash:

```sh
set -a; . .env.testing; set +a;
```

Set `DB_HOST` to `mysql.test` (the service name in `docker-compose.yml`)

Run the `mysql.test` `docker-compose` service (but first, `laravel.test`
service must be running as described above):

```sh
docker-compose up mysql.test
```

Run php tests once and exit:

```sh
npm run nps -- php.t.t
```

Watch and re-run php tests when files change:

```sh
npm run nps -- php.t
```

### Javascript

Run vue tests once and exit:

```sh
npm run nps -- vue.t.t
```

Watch and re-run tests on file changes

```sh
npm run nps -- vue.t
```
