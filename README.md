# hh2017
- install LAMPstack on your server. If you are using AWS, here is a tutorial: https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/install-LAMP.html 
- `git clone git@github.com:JohnSimerlink/hh2017.git` onto your server
- copy or symlink the `hh2017/php-app/hackerheaven2017/html` to your webroot. For apache your webroot will be at /var/www/html
- Make sure the user(s) apache and/or php runs as have the correct chmod permissions for your webroot
- create a mysql database using the configurations specified in `hh2017/php-app/hackerheaven2017/includes/db_config.php`
- to login to the db do something like `mysql --username=USERNAME --host=localhost --password DATABASE_NAME`
- make sure to not allow any MYSQL edit priveleges for mysql user that the php app will be using, or else a participant could pown the db
- if you get a mysql connection error, make sure you have mysql running by running `sudo service mysqld start`
- `cd hh2017/php-app/hackerheaven2017` && `docker run -v \`pwd\`:/var/www/hh -p 8090:80 -it linode/lamp /bin/bash`
