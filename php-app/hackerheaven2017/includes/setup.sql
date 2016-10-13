CREATE DATABASE if not exists hhdata;
USE hhdata;

CREATE TABLE if not exists users(
id int NOT NULL,
username varchar(255),
password varchar(255),
is_admin varchar(255),
PRIMARY KEY (id)
);


#Privileges for `hh_data`@`localhost`

#GRANT USAGE ON *.* TO 'webuser'@'localhost' IDENTIFIED BY PASSWORD '*4BEFD891A3F0E7E89BA44E66FCB37375A4183486';

GRANT SELECT ON hhdata.users TO 'webuser'@'localhost' IDENTIFIED BY '*4BEFD891A3F0E7E89BA44E66FCB37375A4183486';






