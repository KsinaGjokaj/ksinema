.PHONY: start stop shell

shell:
	docker-compose exec porto-corsini-fe sh

#build docker container
build:
	docker-compose up -d --build --remove-orphans
#up docker container
up:
	docker-compose up -d --remove-orphans
#down docker container
down:
	docker-compose down
#restart docker container
restart:
	docker-compose restart
#stop docker container
stop:
	docker-compose stop
	
