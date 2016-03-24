.PHONY: i u

i:
	composer install --ignore-platform-reqs --profile --optimize-autoloader

u:
	composer update --ignore-platform-reqs -vv

