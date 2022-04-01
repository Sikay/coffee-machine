SHELL=/bin/sh

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  composer/install         💻 Installs all the dependencies"
	@echo "  composer/update          ⏫ updating all the dependencies"
	@echo "  composer/dump-autoload   ⏫ updating autoload class"
	@echo "  test                     ✅ Running all the tests"
	@echo "  mutant testing           ✅ Running all the mutant testing"
	@echo "  test/all                 ✅ Running all the tests and all the mutant testing"
	@echo "  coverage                 ✅ Running all the tests and generate html coverage"



composer/dump-autoload: 
	docker/composer dump-autoload --ignore-platform-reqs
	docker/build
	@echo "🌟 All the done"

composer/install: 
	docker/composer install --ignore-platform-reqs
	docker/build
	@echo "🌟 All the done"

composer/update: 
	docker/composer update --ignore-platform-reqs
	@echo "🌟 All the dependencies are updated done"

test:
	docker/test

mutan-testing:
	docker/infection

test/all: 
	test mutan-testing

coverage:
	docker/test --coverage-html htmlCoverages