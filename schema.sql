CREATE TABLE notes(
    id      INT          NOT NULL AUTO_INCREMENT,
    uuid    VARCHAR(255) NOT NULL UNIQUE,
    title   VARCHAR(255) NOT NULL,
    content TEXT         NOT NULL,
    updated DATE         NOT NULL,
    PRIMARY KEY (id)
)