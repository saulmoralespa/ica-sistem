#!/bin/bash
heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=ec2-174-129-32-37.compute-1.amazonaws.com
heroku config:set DB_PORT=5432
heroku config:set DB_DATABASE=d9e6k8hehfqlu2
heroku config:set DB_USERNAME=vvnpgmbnkttkry
heroku config:set DB_PASSWORD=1f067e2f34fef51159764491844291677d0070aa09de7252d609c28f9c57d3f1

heroku config:set APP_NAME=ICA
heroku config:set APP_URL=http://ica-system.herokuapp.com

heroku config:set MAIL_USERNAME=6562f3bf34856d
heroku config:set MAIL_PASSWORD=20855b2660ab27
heroku config:set MAIL_ENCRYPTION=tls

heroku run php artisan migrate:fresh --seed