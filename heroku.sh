#!/bin/bash
heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=ec2-174-129-32-37.compute-1.amazonaws.com
heroku config:set DB_PORT=5432
heroku config:set DB_DATABASE=d9e6k8hehfqlu2
heroku config:set DB_USERNAME=vvnpgmbnkttkry
heroku config:set DB_PASSWORD=1f067e2f34fef51159764491844291677d0070aa09de7252d609c28f9c57d3f1

heroku config:set APP_DEBUG=true
heroku config:set APP_NAME=ICA
heroku config:set APP_URL=http://ica-system.herokuapp.com
