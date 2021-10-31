CREATE TABLE comments (
    cid INT(13) not null PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) not null,
    date DATETIME not null,
    message TEXT not null
);

CREATE TABLE users (
id integer(13) NOT NULL PRIMARY KEY AUTO_INCREMENT,
username varchar(128) NOT NULL,
password varchar(128) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', '123');
INSERT INTO users (username, password) VALUES ('robi', '321');