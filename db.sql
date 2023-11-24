CREATE DATABASE tesis;
CREATE TABLE users (rut INT NOT NULL UNIQUE PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    surname VARCHAR(128) NOT NULL,
    description VARCHAR(1000),
    email VARCHAR(128),
    phone INT,
    password VARCHAR(256) NOT NULL,
    imageURL VARCHAR(256));
--CREATE TABLE userTesist (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
--CREATE TABLE userTutor (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT UNIQUE,
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT UNIQUE,
    subject VARCHAR(64) NOT NULL,
    body VARCHAR(1000),
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    objective VARCHAR(128),
    area VARCHAR(128),
    abstract VARCHAR(1000));
CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(128) NOT NULL,
    description VARCHAR(1000),
    image VARCHAR(256),
    publicationDate DATE NOT NULL,
    realizationDate DATE);

INSERT INTO users VALUES
    (207515841, 'Celeste', 'Marambio', NULL, 'celestemarmar2@gmail.com', 42707297, '$2y$10$YAw0revZnPwc1qD9igTrn.Cgl4qUOVlPkelK2jAUWB3fOHxmzF2be', NULL);