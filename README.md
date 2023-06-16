# Base Application

OBS.: If in your conf docker compose command is used as "docker-compose", please, make adjustments in code before continue.
This project default is "docker compose".

## Info

Laravel Version: 9.52.9

PHP Version: 8.1.20 - *Dependency*

Composer Version: 2.5.8 - *Dependency*

## Steps 

### Clone repository

`git clone git@github.com:aureanemoraes/baseproject-cc.git`

### Enter folder

`cd baseproject-cc/project`

### Get .env

`cp .env.example .env`

### Run docker compose

`docker compose -f ../docker-compose.yaml up -d`

### Init commands with make

`make init`

### Testing

`http://localhost:8080/`

Must show default welcome laravel
