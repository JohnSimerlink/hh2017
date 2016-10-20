CREATE DATABASE if not exists hhdata;
USE hhdata;

CREATE TABLE if not exists users(
id int NOT NULL,
username varchar(255),
password varchar(255),
is_admin varchar(255),
zipcode int,
PRIMARY KEY (id)
);

INSERT into users VALUES(2,'leroyj','atleastigotchicken', 'false', 45241);
INSERT into users VALUES(3,'tailopez', 'knawledge', 'false', 90068);
INSERT into users VALUES(4,'harambe', 'innocent', 'true', 45212);
#Privileges for `hh_data`@`localhost`

#GRANT USAGE ON *.* TO 'webuser'@'localhost' IDENTIFIED BY PASSWORD '*4BEFD891A3F0E7E89BA44E66FCB37375A4183486';

GRANT select ON hhdata.* to 'webuser2'@'localhost' IDENTIFIED by 'TurkeyDayApproachesYum';







