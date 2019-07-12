all: app-base app-dev app-prod web db

include docker.mk

HASH = $(shell git rev-parse --short HEAD)
TEST = docker-compose -f docker-compose.tests.yml -p sttest

app-base:
	@echo Building base image...
	@docker build -t $(REGISTRY)/sendgrid-tracking:$(HASH)-base -f docker/app/Dockerfile.base .
	@docker tag $(REGISTRY)/sendgrid-tracking:$(HASH)-base $(REGISTRY)/sendgrid-tracking:base

app-dev:
	@echo Building development image...
	@docker build -t $(REGISTRY)/sendgrid-tracking:$(HASH)-development -f docker/app/Dockerfile.development docker/app
	@docker tag $(REGISTRY)/sendgrid-tracking:$(HASH)-development $(REGISTRY)/sendgrid-tracking:development

app-prod:
	@echo Building base image...
	@docker build -t $(REGISTRY)/sendgrid-tracking:$(HASH) -f docker/app/Dockerfile.production .
	@docker tag $(REGISTRY)/sendgrid-tracking:$(HASH) $(REGISTRY)/sendgrid-tracking:latest

web:
	@echo Building web image...
	@docker build -t $(REGISTRY)/sendgrid-tracking-web:$(HASH) docker/web
	@docker tag $(REGISTRY)/sendgrid-tracking-web:$(HASH) $(REGISTRY)/sendgrid-tracking-web:latest

db:
	@echo Building db image...
	@docker build -t $(REGISTRY)/sendgrid-tracking-db:$(HASH) docker/db
	@docker tag $(REGISTRY)/sendgrid-tracking-db:$(HASH) $(REGISTRY)/sendgrid-tracking-db:latest

test:
	@$(TEST) down -v
	@$(TEST) run --rm app
	@$(TEST) down -v

pull-deps:
	@docker pull php:7.1-fpm-alpine
	@docker pull postgres:9
	@docker pull nginx:1.11-alpine
	@docker pull namshi/smtp:latest

push:
	@docker push $(REGISTRY)/sendgrid-tracking:$(HASH)-base
	@docker push $(REGISTRY)/sendgrid-tracking:base
	@docker push $(REGISTRY)/sendgrid-tracking:$(HASH)-development
	@docker push $(REGISTRY)/sendgrid-tracking:development
	@docker push $(REGISTRY)/sendgrid-tracking:$(HASH)
	@docker push $(REGISTRY)/sendgrid-tracking:latest
	@docker push $(REGISTRY)/sendgrid-tracking-web:$(HASH)
	@docker push $(REGISTRY)/sendgrid-tracking-web:latest
	@docker push $(REGISTRY)/sendgrid-tracking-db:$(HASH)
	@docker push $(REGISTRY)/sendgrid-tracking-db:latest
