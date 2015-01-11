DROP DATABASE IF EXISTS regularexpr;
CREATE DATABASE regularexpr;
USE regularexpr;

CREATE TABLE gebruiker(
	id int(11) NOT NULL AUTO_INCREMENT,
	inlognaam VARCHAR(30) NOT NULL,
	wachtwoord varchar(70) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE gebruikerinfo(
	id int(11) NOT NULL AUTO_INCREMENT,
	gebruiker_id int(11) NOT NULL,
	email varchar(360),
	straat varchar(255),
	huisnummer varchar(10),
	postcode varchar(6),
	PRIMARY KEY(id)
);