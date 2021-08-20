test : tests
	./vendor/bin/phpunit

migrate :
	./vendor/bin/phinx migrate

run :
	php -S localhost:8000 -t public

install : composer.json
	composer install

update : composer.json
	composer update