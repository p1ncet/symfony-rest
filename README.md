Installation
------------

`docker/.env` contains default settings (ports mainly) for docker containers.

Build: `docker-compose build`

Run: `SERVER_PORT=8888 docker-compose up`

Enter console: `docker exec -it restest_php-fpm_1 bash`

Installation
------------

Here is a list of api endpoints: `tests/rest-api.http` 