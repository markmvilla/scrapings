#CREATE DATABASE database_name;

CREATE TABLE schools(
   school VARCHAR(225) NOT NULL PRIMARY KEY
);

CREATE TABLE courses(
   course VARCHAR(225) NOT NULL PRIMARY KEY,
   school VARCHAR(225) NOT NULL
);

CREATE TABLE classes(
   class VARCHAR(225) NOT NULL PRIMARY KEY,
   course VARCHAR(225) NOT NULL,
   school VARCHAR(225) NOT NULL
);

CREATE TABLE ids(
   id INT NOT NULL PRIMARY KEY,
   message VARCHAR(225) NOT NULL,
   question VARCHAR(225) NOT NULL,
   class VARCHAR(225) NOT NULL,
   course VARCHAR(225) NOT NULL,
   school VARCHAR(225) NOT NULL
);

CREATE USER 'user_name'@'database_hostname' IDENTIFIED BY 'password';

GRANT SELECT, INSERT, UPDATE, DELETE ON `database_name`.* TO 'username'@'db.tcuexchange.com';

FLUSH PRIVILEGES;
