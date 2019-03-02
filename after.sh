#!/bin/sh

/usr/bin/php /home/vagrant/code/artisan migrate


sudo touch /etc/supervisor/conf.d/artisan_queue.conf
sudo echo "[program:worker]
command=/usr/bin/php /home/vagrant/code/artisan queue:work
autostart=true
autorestart=true
user=www-data
stopsignal=KILL
numprocs=1" > /etc/supervisor/conf.d/artisan_queue.conf
sudo /etc/init.d/supervisor restart
