up:
	docker compose up -d
build:
	docker compose build --no-cache --force-rm
laravel-install:
	docker compose exec app composer create-project --prefer-dist laravel/laravel .
create-project:
	mkdir -p backend
	@make build
	@make up
	@make laravel-install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan storage:link
	docker compose exec app chmod -R 777 storage bootstrap/cache
	@make fresh
init: ## 初期設定
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app chown www-data storage/ -R
	docker compose exec app cp .env.example .env
	docker compose exec app php artisan key:generate
	@fresh
remake: ## 環境の再設定
	@make destroy
	@make init
stop:
	docker compose stop
down: ## コンテナの破棄
	docker compose down --remove-orphans
restart: ## コンテナの再作成
	@make down
	@make up
destroy: ## 環境を全削除
	docker compose down --rmi all --volumes --remove-orphans
destroy-volumes:
	docker compose down --volumes --remove-orphans
ps:
	docker compose ps
prune: ## 未使用イメージを削除
	docker image prune

migrate: ## マイグレーション
	docker compose exec app php artisan migrate
fresh: ## seederの挿入
	docker compose exec app php artisan migrate:fresh --seed

# コンテナ作業
db: 
	docker compose exec db bash
web:
	docker compose exec web ash
app: ## appコンテナに入る
	docker compose exec app bash

sql: # データベース操作
	docker compose exec db bash -c 'mysql -u $$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DATABASE'

# help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'