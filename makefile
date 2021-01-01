build:
	docker-compose build --no-cache --force-rm

dev:
	make client-dev & make admin-dev

client-dev:
	cd client && npm run dev

admin-dev:
	cd admin && npm run dev

init:
	docker-compose up -d &&\
	@make build &&\
	docker-compose exec app php -r "file_exists('.env') || copy('.env.example', '.env');" &&\
	docker-compose exec app composer install &&\
	docker-compose exec app php artisan key:generate &&\
	docker-compose exec app php artisan storage:link &&\
	docker-compose exec app chmod -R 777 storage &&\
	docker-compose exec app chmod -R 777 bootstrap/cache &&\
	docker-compose exec app php artisan config:cache

install:
	docker-compose exec app composer install

backend-test:
	docker-compose exec app composer test

dry-cs:
	docker-compose run cs fix --dry-run -v --diff --diff-format udiff .

fix-cs:
	docker-compose run cs fix -v --diff --diff-format udiff .

sql:
	docker-compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'
