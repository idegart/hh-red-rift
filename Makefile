start:
	docker-compose up -d
	cp .env.example .env
	docker-compose exec app php artisan key:generate

stop:
	docker-compose down

test:
	docker-compose exec app php artisan test