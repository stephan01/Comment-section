CREATE TABLE comments (
    cid INT(13) not null PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) not null,
    date DATETIME not null,
    message TEXT not null
);