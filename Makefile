migrate-create:
	docker-compose exec php-cli php bin/console make:migration

migrate-prev:
	docker-compose exec php-cli php bin/console doctrine:migrations:migrate prev --no-interaction

migrate:
	docker-compose exec php-cli php bin/console doctrine:migration:migrate --no-interaction