# Lumen & vue

Login and dashboard example with JWT token and REST api.

## INSTALLATION

Download repository
```
git clone https://github.com/albert-ramos/hd-test.git
```

Download dependencies
```
cd hd-test && composer install && npm install
```

Copy .env.example to .env
Configure your DB settings to .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hd_test
DB_USERNAME=root
DB_PASSWORD=secret
```

Run migrations
```
php artisan migrate:refresh --seed
```

Start server
```php
php -S localhost:8000 -t public
```

Build assets
```
npm run prod
```

Go to your browser and visit
http://localhost:8000

Login
```
admin@example.com
```
```
example
```

## TO DO

- Unit testing
- Add color picker
- Add frontend dotenv
- Refactor session object.
- **Use MongoDB not MySQL**
- **Create register page**
- Update gitignore with folder **public/**
- Encrypt user data saved on local storage.
- Handle status codes 401, 403, auto logout on session expired.



### BUGFIX
- On dashboard, if you change the template from existing widget it may overlap to another widget.

##### IMPROVEMENTS
- Add some style animations & transitions
