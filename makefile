dev:
	make client-dev & make admin-dev

client-dev:
	cd client && npm run dev

admin-dev:
	cd admin && npm run dev

install:
	docker-compose exec app composer install

backend-test:
	docker-compose exec app composer test

dry-cs:
	docker-compose run cs fix --dry-run -v --diff --diff-format udiff .

fix-cs:
	docker-compose run cs fix -v --diff --diff-format udiff .
