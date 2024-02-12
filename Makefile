check: cs-fix check-cs stan psalm
cs-fix:
	docker compose exec php-cli vendor/bin/phpcbf
check-cs:
	docker compose exec php-cli vendor/bin/phpcs
stan:
	docker-compose exec php-cli vendor/bin/phpstan analyze --memory-limit=512m
psalm:
	docker-compose exec php-cli vendor/bin/psalm

refresh: drop-database create-database migrate
drop-database:
	docker-compose exec php-cli php bin/console doctrine:database:drop --if-exists --force --no-interaction
create-database:
	docker-compose exec php-cli php bin/console doctrine:database:create --no-interaction
create-migration:
	docker-compose exec php-cli php bin/console make:migration
migrate:
	docker-compose exec php-cli php bin/console doctrine:migrations:migrate --no-interaction

docker-start:
	docker compose up -d
composer-install:
	docker compose exec php-cli composer install -vv -o

start: docker-start composer-install migrate