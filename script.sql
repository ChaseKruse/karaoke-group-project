use z1844922;

DROP TABLE IF EXISTS song;
DROP TABLE IF EXISTS songc;
DROP TABLE IF EXISTS contributor;
DROP TABLE IF EXISTS karaoke;
DROP TABLE IF EXISTS queue;
DROP TABLE IF EXISTS user;

CREATE TABLE song(
	songid INT AUTO_INCREMENT PRIMARY KEY,
	songtitle VARCHAR(50),
	songartist VARCHAR(50)
);

CREATE TABLE songcontributor(
	scid INT AUTO_INCREMENT PRIMARY KEY,
	songid INT,
	contributorid INT,
	scrole VARCHAR(50)
);

CREATE TABLE contributor(
	contributorid INT AUTO_INCREMENT PRIMARY KEY,
	contributorname VARCHAR(50)
);

CREATE TABLE karaoke(
	fileid INT AUTO_INCREMENT PRIMARY KEY,
	songid INT
);

CREATE TABLE queue(
	queueid INT AUTO_INCREMENT PRIMARY KEY,
	userid INT,
	fileid INT,
	queuedate DATETIME,
	amountpaid FLOAT
);

CREATE TABLE user(
	userid INT,
	username VARCHAR(50)
);
