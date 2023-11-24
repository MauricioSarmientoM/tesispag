CREATE DATABASE tesis;
CREATE TABLE users (rut INT NOT NULL UNIQUE PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    surname VARCHAR(128) NOT NULL,
    description VARCHAR(1000),
    email VARCHAR(128),
    phone INT,
    password VARCHAR(256) NOT NULL,
    imageURL VARCHAR(256)
    direction VARCHAR(128));
--CREATE TABLE userTesist (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
--CREATE TABLE userTutor (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT UNIQUE,
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT UNIQUE,
    subject VARCHAR(64) NOT NULL,
    body VARCHAR(1000),
    readed BOOLEAN,
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    objective VARCHAR(128),
    area VARCHAR(128),
    abstract VARCHAR(1000));
CREATE TABLE workuser (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT NOT NULL,
    idWork INT NOT NULL);
CREATE TABLE workfile (id INT AUTO_INCREMENT PRIMARY KEY,
    idWork INT NOT NULL,
    files VARCHAR(256));
CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(128) NOT NULL,
    description VARCHAR(1000),
    image VARCHAR(256),
    publicationDate DATE NOT NULL,
    realizationDate DATE);

INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES
    (20751584, 'Celeste', 'Marambio', NULL, 'celestemarmar2@gmail.com', 42707297, '$2y$10$YAw0revZnPwc1qD9igTrn.Cgl4qUOVlPkelK2jAUWB3fOHxmzF2be', NULL, 'Caburga 1105 Villa Arauco'),
    (20036002, 'Javier', 'Ponce', NULL, NULL, NULL, '$2y$10$Cec.pJ3phzGzqBEwrOi97.wJ9Ym4m61bA8VxjlgHSoIaL9IElGrA2', NULL, 'Los Carreras 3465 Villa Modelo'),
    (20864127, 'Gutemberg', 'Ávila', NULL, NULL, 'gutemberg.avila.21@alumnos.uda.cl', '$2y$10$YpicIYKSxAWXl8VMKpTen.sw/OEhKX1.ute5YLOTG.4wFYzPIPvW', NULL, 'Aldunate 402'),
    (21239226, 'José', 'Herrera', NULL, NULL, 'jose.herrera.21@alumnos.uda.cl', '$2y$10$OGx49VYwFcPcPLAqyMOQZOp1v6wIV6AqgRb9prAjdC5OFlc4VuDK2', NULL, 'Guacolda 1062 Ampliacion Prat'),
    (1, 'root', 'user', NULL, NULL, NULL, '$2y$10$A4vsESvIBw2iFHlYdUd3M.cjzOzL5JNrhAX2OxyKBTKdwOS9ahC0S', NULL, NULL);
INSERT INTO super (rut) VALUES
    (20751584),
    (1);
INSERT INTO contact (rut, subject, body) VALUES
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.')
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.')
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.')
    (20864127, 'Invitar colaboradores', 'Como se añaden compañeros a las tesis???');
INSERT INTO works ()