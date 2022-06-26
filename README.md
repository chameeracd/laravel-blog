## Installation

```
git clone git@github.com:chameeracd/laravel-blog.git
cd laravel-blog

composer update
```
update .env file & create the database
```
php artisan migrate
npm install && npm run dev

php artisan serve
```

## Testing
update .env.testing file & create the test database
```
php artisan migrate --env=testing
php artisan key:generate --env=testing

php artisan test
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
