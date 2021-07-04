# Furniture Shop

A demo application to learn stripe integration.

## Installation

```sh
git clone https://github.com/rahulkhimsuriya/laravel-furniture-shop-stripe-payment.git

cd laravel-furniture-shop-stripe-payment
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm install
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly. [Read more](https://laravel.com/docs/8.x/database)

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Setup [stripe](https://dashboard.stripe.com) configuration:

```dotenv
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
```

Setup [stripe webhook](https://stripe.com/docs/connect/webhooks) configuration:

1. Add new `webhook endpoint`
2. Select event **`checkout.session.completed`**

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit [**`Furniture Shop`**](http://localhost:8000) in your browser, and login with:

-   **Username:** johndoe@example.com
-   **Password:** password

## Thank you.
