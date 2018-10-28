#!/bin/bash
heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=ec2-54-83-49-109.compute-1.amazonaws.com
heroku config:set DB_PORT=5432
heroku config:set DB_DATABASE=d62jo1jcj1j6lv
heroku config:set DB_USERNAME=dupduzqtnyycus
heroku config:set DB_PASSWORD=0cd3fa88f36c0920a61eb0736383b4081193f9c459342b0d9e287cbea67d2361

heroku config:set APP_NAME=ICA
heroku config:set APP_URL=http://ica-sistem.herokuapp.com

heroku config:set MAIL_USERNAME=6562f3bf34856d
heroku config:set MAIL_PASSWORD=20855b2660ab27
heroku config:set MAIL_ENCRYPTION=tls

heroku run php artisan migrate:fresh --seed