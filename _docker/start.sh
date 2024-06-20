#!/bin/bash

service apache2 restart

php artisan jwt:secret

tail -f /dev/null
