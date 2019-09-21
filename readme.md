# Lumen & vue

Login and dashboard example with JWT token and REST api.

## INSTALLATION

Download repository
```git clone https://github.com/albert-ramos/hd-test.git```

Download dependencies
```composer install && npm install```

Run migrations
```php artisan migrate:refresh --seed```

Start server
```php
php -S localhost:8000 -t public
```

Build assets
```npm run prod```

Go to your browser and visit
http://localhost:8000



## TO DO

- Unit testing
- Add color picker
- Refactor session object.
- Use MongoDB not MySQL
- Create register component
- Encrypt user data saved on local storage.
- Handle status codes 401, 403, auto logout on session expired.


### BUGFIX
- On dashboard, if you change the template from existing widget it may overlap to another widget.

##### IMPROVEMENTS
- Add some style animations & transitions