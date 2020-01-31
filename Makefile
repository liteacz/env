#!/usr/bin/env bash

UID = $$(id -u)

runTests:
	docker run -v ${PWD}:/data registry.gitlab.litea.cz/images/php/7.3-fpm-alpine/dev:v2.5.1 php ./vendor/bin/phpunit
