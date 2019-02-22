web: vendor/bin/heroku-php-apache2 public/
release: composer run-script post-root-package-install && php artisan key:generate --ansi && php artisan migrate --force
