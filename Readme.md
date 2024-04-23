# How to test:

in order to run tests you can follow one of the below approaches:

### using PHP and Composer CLI

if you have PHP 8.3+ and Composer cli setuped, run the below commands in the project's root directory to invoke tests:

```bash
composer install && ./vendor/bin/phpunit
```

### using Docker

You can easily run below command in the project's root directory to run tests using docker:

```bash
# to install dependencies and run tests
docker run --rm -it --volume $(pwd):/app composer:2.7 make

# to only run tests (if you have installed dependencies upfront)
docker run --rm -it --volume $(pwd):/app composer:2.7 make phpunit
```

for more details please also check `makefile` in the project's root directory.
