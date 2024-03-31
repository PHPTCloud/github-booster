ARGS=$(filter-out $@, $(MAKECMDGOALS))

init: create-env docker-build docker-up composer-install

up: create-env docker-up composer-install

build: docker-build

create-env:
	cp -n .env-sample .env

docker-up:
	docker compose up -d --remove-orphans

docker-build:
	docker compose build

composer-install:
	docker compose exec app composer i
