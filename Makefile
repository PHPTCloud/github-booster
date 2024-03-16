ARGS=$(filter-out $@, $(MAKECMDGOALS))

init: docker-build docker-up composer-install

up: docker-up composer-install

build: docker-build

docker-up:
	docker compose up -d --remove-orphans

docker-build:
	docker compose build

composer-install:
	docker compose exec app composer i
