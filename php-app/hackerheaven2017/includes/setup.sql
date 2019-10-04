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
INSERT into users VALUES(4,'harambe', 'innocent', 'true', 45202);

CREATE TABLE if not exists secure_users(
	id int NOT NULL,
	username varchar(255),
	password varchar(255),
	is_admin varchar(255),
	fav_number int,
	PRIMARY KEY (id)
);
INSERT into secure_users VALUES(1, 'admiralackbar','074487f1c871028c34cf619e2b75e8c5', 'false', 42);
INSERT into secure_users VALUES(2, 'darthplagueis','8853ed14b3e4d04024059ef85af95ea1', 'true', 4);
INSERT into secure_users VALUES(3, 'patton', '10c526c0946f205b658438384fb02553', 'false', 7); 
INSERT into secure_users VALUES(3, 'eisenhower', 'e094f13f65cf61637fe973d7e8935ee6', 'false', 3); 

CREATE Table if not exists people(
	id int NOT NULL,
	username varchar(255),
	height varchar(255),
	age int,
	PRIMARY KEY (id)
);
INSERT into people VALUES (2, 'bob', '5\' 7"', 14);
INSERT into people VALUES (3, 'rebecca', '5\' 8"', 15);
INSERT into people VALUES (4, 'shaquille', '6\' 12"', 42);
INSERT into people VALUES (5, 'techolympics', 'NA', 8);

GRANT select ON hhdata.* to 'webuser2'@'localhost' IDENTIFIED by 'TurkeyDayApproachesYum';
