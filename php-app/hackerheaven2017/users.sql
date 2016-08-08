# Privileges for `hh_StkafynS`@`localhost`

GRANT USAGE ON *.* TO 'hh_StkafynS'@'localhost' IDENTIFIED BY PASSWORD '*3C158534EEEF3065481BF25FF0F246B1A0876A17';

GRANT SELECT, INSERT, UPDATE ON `hh\_login`.* TO 'hh_StkafynS'@'localhost';


# Privileges for `hh_data`@`localhost`

GRANT USAGE ON *.* TO 'hh_data'@'localhost' IDENTIFIED BY PASSWORD '*30C1C5230CE3256858195280DF357DBAB514C33E';

GRANT SELECT ON `hh\_data`.* TO 'hh_data'@'localhost';
