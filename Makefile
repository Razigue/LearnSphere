.PHONY: up down build watch package create-block db-export db-import db-latest wp-shell seed

up:
	@npm start

down:
	@npm stop

build:
	@npm run build

watch:
	@npm run watch

package:
	@npm run package

seed:
	@npm run wp-env run cli wp eval-file wp-content/plugins/learnsphere-plugin/includes/seed-data.php

create-block:
	@npm run create-block

db-export:
	mkdir -p database/dumps
	npm run wp-env -- run cli wp db export "database/dumps/dump-$$(date +%F-%H\H%M)-$${USER}.sql"

# Usage:
# make db-import FILE=database/dumps/dump-2026-04-22-2231-sofian.sql
db-import:
	npm run wp-env -- run cli wp db import "$${FILE}"

db-latest:
	npm run wp-env -- run cli wp db import database/latest.sql

# Open the interactive WordPress shell for the development instance.
wp-shell:
	npm run wp-env cli wp shell

# Destroy the WordPress environment.
# Deletes docker containers, volumes, and networks associated with the WordPress environment
# and removes local files.
destroy:
	npm run wp-env destroy