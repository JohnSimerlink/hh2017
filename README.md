# hh2017
- install LAMPstack on your server. If you are using AWS, here is a tutorial: https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html 
- `git clone git@github.com:JohnSimerlink/hh2017.git` onto your server
- copy or symlink the `hh2017/php-app/hackerheaven2017/html` to your webroot. For apache your webroot will be at /var/www/html
- Make sure the user(s) apache and/or php runs as have the correct chmod permissions for your webroot
- create a mysql database using the configurations specified in `hh2017/php-app/hackerheaven2017/includes/db_config.php`
- to login to the db do something like `mysql --username=USERNAME --host=localhost --password DATABASE_NAME`
- make sure to not allow any MYSQL edit priveleges for mysql user that the php app will be using, or else a participant could pown the db
- if you get a mysql connection error, make sure you have mysql running by running `sudo service mysqld start`
## Acutal instructions
- `cd hh2017/php-app/hackerheaven2017`
`docker run -v `pwd`:/var/www/hh -v $(pwd)/hackerheaven.tk.conf:/etc/apache2/conf.d/sites-enabled/hackerheaven.tk.conf -v $(pwd)/sites-enabled/:/etc/apache2/sites-enabled/ -p 8120:80 -it linode/lamp /bin/bash`
## Once inside of the docker container
- `/etc/init.d/mysql stop`
- `sudo mysqld_safe & mysql -u root`
- now that you are inside of the mysql command line,  do `source includes/setup.sql`;
- `apt update`
- `apt install php5-mysqlnd`
- `service apache2 restart`
