use z1844922;

DROP TABLE IF EXISTS song;
DROP TABLE IF EXISTS songcontributor;
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
	filedesc VARCHAR(50),
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
	userid INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50)
);

INSERT INTO song(songtitle, songartist) VALUES
('Gods Plan', 'Drake'),
('Shake It Off', 'Taylor Swift'),
('Baby', 'Justin Bieber'),
('Rule The World', '2 Chainz'),
('Rockstar', 'Post Malone'),
('Moby Dick', 'Led Zeppelin'),
('EARFQUAKE', 'Tyler, The Creator'),
('Rock with You', 'Micheal Jackson'),
('Location', 'Playboi Carti'),
('Jailbreak the Tesla', 'Injury Reserve'),
('Hustle Bones', 'Death Grips'),
('Iron', 'Woodkid');

INSERT INTO songcontributor(songid, contributorid, scrole) VALUES
(5, 3, 'Singer'),
(3, 1, 'Singer'),
(4, 2, 'Singer'),
(6, 4, 'Drummer'),
(6, 5, 'Guitarist'),
(10, 6, 'Rapper');

INSERT INTO contributor(contributorname) VALUES
('Ludacris'),
('Ariana Grande'),
('21 Savage'),
('John Bonham'),
('Jimmy Page'),
('Amime');

INSERT INTO karaoke(songid, filedesc) VALUES
(1, "Original"),
(2, "Original"),
(3, "Original"),
(4, "Original"),
(5, "Original"),
(5, 'Bass Boosted'),
(6, "Original"),
(7, "Original"),
(8, "Original"),
(9, "Original"),
(10, "Original"),
(11, "Original"),
(12, "Original"),
(12, "Acoustic Version"),
(12, "Mystery Jets Remix");

INSERT INTO user(username) VALUES
('Curtis'),
('Cortland'),
('Chase'),
('Li'),
('Noah');
