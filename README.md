# Base Application

OBS.: If in your conf docker compose command is used as "docker-compose", please, make adjustments in code before continue.
This project default is "docker compose".

## Info

Laravel Version: 9.52.9

PHP Version: 8.1.20 - *Dependency*

Composer Version: 2.5.8 - *Dependency*

## Initial steps 

### Clone repository

`git clone git@github.com:aureanemoraes/angra-env.git`

### Enter folder

`cd angra-env/projects/authservice`

### Get .env

`cp .env.example .env`

### Before run docker compose, configure host file

#### On linux

Add on /etc/hosts

`127.0.0.1       authservice.desenv`

#### On windows or WSL2

Add on C:\Windows\System32\drivers\etc\hosts

`127.0.0.1       authservice.desenv`

### Run docker compose

`cd ../../ && docker compose up -d`

### Init commands with make

`cd projects/authservice && make init`

### Testing

`http://authservice.desenv:8080/`

Must show default welcome laravel

## Adding new project to nginx configuration

If you create a new project on projects folder, it will be shared with phpfpm and nginx container, but some steps are necessary to nginx work with this new project

### Configuring conf file

1. Make a copy of *site.conf.example in* nginx *.docker/opt/docker/etc/nginx* directory and rename with your server name

ex.:

`cp site.conf.example myproject.conf`

2. Change the *server_name* value to the name you want

3. Change the *project_folder* in *root* value to the name of your project directory

4. After that, you must set the server_name of you application into your /etc/hosts file. This step is showed above.
