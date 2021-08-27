#!/usr/bin/env sh
#
# cmd.sh
#
set -e

ROOT_PATH=$(cd $(dirname $0) && pwd)
if [ -z "${ROOT_PATH}" ]; then
  # error; for some reason, the path is not accessible
  # to the script (e.g. permissions re-evaled after suid)
  echo 'ERR: Script path is for some reason not accessible' >&2
  exit 1 # fail
fi
cd "${ROOT_PATH}"

###Functions
docker_compose_override() {
  if [ -f "docker-compose.override.yml" ]; then
    echo " -f docker-compose.override.yml"
  fi
}

up() {
  docker-compose -f docker-compose.yml$(docker_compose_override) up -d
}
###/Functions

case "${1}" in
"up")
  up
  ;;

"down")
  docker-compose -f docker-compose.yml$(docker_compose_override) down
  ;;

"logs")
  docker-compose -f docker-compose.yml$(docker_compose_override) logs -f
  ;;

"shell")
  docker-compose -f docker-compose.yml$(docker_compose_override) exec php_dev ash
  ;;

*)
  echo "${0} - help"
  echo "-----"
  echo "Usage:"
  echo "${0} up"
  echo "${0} down"
  echo "${0} logs"
  echo "${0} shell"
  ;;
esac
