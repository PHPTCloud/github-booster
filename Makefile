ARGS=$(filter-out $@, $(MAKECMDGOALS))


up: docker-up

build: docker-build

app: docker-app

docker-up:
	docker compose up -d --remove-orphans

docker-build:
	docker compose build

docker-app:
	docker compose exec app ${ARGS}
