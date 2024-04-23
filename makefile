default: dependencies phpunit

phpunit:
	./vendor/bin/phpunit

dependencies:
	composer install

.PHONY: phpuit dependencies