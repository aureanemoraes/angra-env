CONTAINER_FPM_NAME := base-php81-fpm
CONTAINER_DB_NAME := base-project-mysql
CONTAINER_NGINX_NAME := base-project-nginx
DIRECTORY_APP_NAME := authservice

init: ## Start a new develop environment
	$(MAKE) install
	$(MAKE) keys
	$(MAKE) fresh
	$(MAKE) seed

keys: ## Generate secret keys
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan key:generate"

install: ## Composer install dependencies
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && composer install"

##@ Database tools

migration: ## Create migration file
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan make:migration $(name)"

migrate: ## Perform migrations
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan migrate"

horizon: ## Start laravel horizon
	docker compose exec -u application $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan horizon"

fresh: ## Perform fresh migrations
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan migrate:fresh"

seed: ## Import database
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan db:seed"

rollback: ## Rollback migration
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan migrate:rollback"

reapply: ## Reapply the last migrations
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan migrate:rollback"
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan migrate"

backup: ## Export database
	docker compose exec $(CONTAINER_DB_NAME) bash -c "mysqldump -u root -p database > /var/www/database/dumps/backup.sql"
	docker compose exec $(CONTAINER_DB_NAME) bash -c "chown 1000:1000 /var/www/database/dumps/backup.sql"

restore: ## Import database
	docker compose exec $(CONTAINER_DB_NAME) bash -c "mysql -u root -p database < /var/www/database/dumps/backup.sql"

route: ## Rollback migration
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && php artisan route:list"

##@ Composer
autoload: ## Run the composer dump
	docker compose exec $(CONTAINER_FPM_NAME) bash -c "cd $(DIRECTORY_APP_NAME) && composer dump-autoload"
##@ Bash controls

fpm: ## Start fpm bash
	docker compose exec $(CONTAINER_FPM_NAME) bash

nginx: ## Start nginx bash
	docker compose exec -u application $(CONTAINER_NGINX_NAME) bash

mysql: ## Start mysql bash
	docker compose exec $(CONTAINER_DB_NAME) bash
