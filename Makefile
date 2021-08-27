@all:
	cat Makefile

up:
	./cmd.sh up

down:
	./cmd.sh down

restart:
	./cmd.sh down && ./cmd.sh up

logs:
	./cmd.sh logs

shell:
	./cmd.sh shell
