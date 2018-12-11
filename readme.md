
What to experinment
===

Things to implement:
- Aggregate 
- commandBus :: Command -> [Event]
- processManager :: [Event] -> [Command]
- projector :: [Event] -> State -> State


Reading List:
- https://lostechies.com/gabrielschenker/2015/04/16/ddd-revisited/
- https://lostechies.com/gabrielschenker/2015/04/28/ddd-applied/
- https://lostechies.com/gabrielschenker/2015/05/25/ddd-the-aggregate/
- https://lostechies.com/gabrielschenker/2015/06/13/event-sourcing-applied-the-application-service/
- https://lostechies.com/gabrielschenker/2015/06/13/event-sourcing-applied-the-application-service/
- https://lostechies.com/gabrielschenker/2015/07/13/event-sourcing-applied-the-repository/

- http://codebetter.com/gregyoung/2009/01/16/ddd-the-generic-repository/
- https://softwareengineering.stackexchange.com/questions/113433/ddd-does-an-aggregate-roots-repository-handle-saving-aggregates
- https://medium.com/@yauritux/ddd-part-ii-b0735ba584ca
- http://danielwhittaker.me/2014/10/02/cqrs-step-step-guide-flow-typical-application/
- http://danielwhittaker.me/2014/11/15/aggregate-root-cqrs-event-sourcing/
- https://exceptionnotfound.net/implementing-cqrs-in-net-part-2-handling-commands-and-events/
- https://github.com/prooph/documentation/blob/2ae6edd0a12b861f39ea7cf7a9bffb76c2f7b3a8/event-store-client/blueprints.md


Starting on the read model
 - https://lostechies.com/gabrielschenker/2015/05/26/event-sourcing-revisited/


####  Running tests
docker-compose exec php-fpm bin/phpunit




#### OLD - Setup Machine Install


`docker-machine create app`

`docker-machine start app`

`eval $(docker-machine env app)`

`docker-compose up --build`

`docker-compose rm app`


**Note:** you need to cd first to where your docker-compose.yml file lives.

  * Start containers in the background: `docker-compose up -d`
  * Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  * Stop containers: `docker-compose stop`
  * Kill containers: `docker-compose kill`
  * View container logs: `docker-compose logs`
  * Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
        * Shell into the PHP container, `docker-compose exec php-fpm bash`
        * Run symfony console, `docker-compose exec php-fpm bin/console`
        * Open a pgsql shell, `docker-compose exec pgsql pgsql -uroot -pCHOSEN_ROOT_PASSWORD`


Cleaning our your machine:
====
Before deleting all the containers, force stop them:
`docker ps -q -a | xargs docker stop`

Then delete the containers using:
`docker ps -q -a | xargs docker rm`

Now delete all the dangling images using:
`docker rmi $(docker images | grep “^<none>” | awk ‘{print $3}’)`