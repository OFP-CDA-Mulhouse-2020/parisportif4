.PHONY: start stop ps prepare test cache-clear

prepare:
	php bin/console cache:clear --env=test
	php bin/console doctrine:database:drop --if-exists -f --env=test
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:schema:update -f --env=test


test:
	${CURDIR}\vendor\bin\simple-phpunit tests/Entity/UserTest.php

cache-clear:
	docker-compose exec php7.4 php bin/console cache:clear

clean:
	rm -f *.dat


