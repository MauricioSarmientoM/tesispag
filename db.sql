CREATE DATABASE tesis;
CREATE TABLE users (rut INT NOT NULL UNIQUE PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    surname VARCHAR(128) NOT NULL,
    description VARCHAR(1000),
    email VARCHAR(128),
    phone INT,
    password VARCHAR(256) NOT NULL,
    imageURL VARCHAR(256),
    direction VARCHAR(128));
--CREATE TABLE userTesist (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
--CREATE TABLE userTutor (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, );
CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT UNIQUE NOT NULL,
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT NOT NULL,
    subject VARCHAR(64) NOT NULL,
    body VARCHAR(1000),
    readed BOOLEAN,
    FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL,
    obj VARCHAR(128),
    area VARCHAR(128),
    abstract VARCHAR(1000),
    image VARCHAR(256));
CREATE TABLE workuser (id INT AUTO_INCREMENT PRIMARY KEY,
    rut INT NOT NULL,
    idWork INT NOT NULL,
    FOREIGN KEY (rut) REFERENCES users(rut),
    FOREIGN KEY (idWork) REFERENCES works(id));
CREATE TABLE workfile (id INT AUTO_INCREMENT PRIMARY KEY,
    idWork INT NOT NULL,
    files VARCHAR(256),
    FOREIGN KEY (idWork) REFERENCES works(id));
CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(256) NOT NULL,
    description VARCHAR(1000),
    image VARCHAR(256),
    publicationDate DATE NOT NULL,
    realizationDate DATE);
INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES
    (20751584, 'Celeste', 'Marambio', NULL, 'celestemarmar2@gmail.com', 42707297, '$2y$10$dmooAIPaTY80/rpajWPfsO/jEdFn8kMD03K6JhFhnhFPjcWgzujWG', NULL, 'Caburga 1105 Villa Arauco'),
    (20036002, 'Javier', 'Ponce', NULL, NULL, NULL, '$2y$10$Q2/JWgpTVCcJ8LrJm2w2b.iwyqaHeRbvXpdUu.4k7aORQUEMxReNm', NULL, 'Los Carreras 3465 Villa Modelo'),
    (20864127, 'Gutemberg', 'Ávila', NULL, 'gutemberg.avila.21@alumnos.uda.cl', NULL, '$2y$10$fdLEEzEZ6zWRo/IQYx8mZeMyeQiUwhRDtOYu0PtBVqcdx4EkfnxS6', NULL, 'Aldunate 402'),
    (21239226, 'José', 'Herrera', NULL, 'jose.herrera.21@alumnos.uda.cl', NuLL, '$2y$10$GRh3DlflxWwBcw/U/U6yGOTEP2d8Nxf.n/gRP/VX/oznKjhE0BOQC', NULL, 'Guacolda 1062 Ampliacion Prat'),
    (15871295, 'Andrés', 'Alfaro', NULL, 'andres.alfaro@uda.cl', NULL, '$2y$10$C9ExGRnNn7VmsLM4FsFeU.GYOGCE5HODOAl3O9ik81qLtUUpDims.', NULL, 'Rio Copiapo 1591 V Valle De Los Rios'),
    (8368745, 'Manuel', 'Monasterio', NULL, 'manuel.monasterio@uda.cl', NULL, '$2y$10$6oZVlFk0H7eupble7f8DXuTzNwn0mlfWvRx54qXwaLUVD5ni0dkhK', NULL, 'Pj Jose O Valdivia 609 Ampl Los Sauces'),
    (13015354, 'Héctor', 'Córnide', NULL, 'hector.cornide@uda.cl', NULL, '$2y$10$OqzqynOEHEbv3aKfdcjSmOkrhE6.RQ0BPC6i3wpC/ioGZt7UG.age', NULL, 'Salitrera Limeñita 2496 El Palomar'),
    (1, 'root', 'user', NULL, NULL, NULL, '$2y$10$A4vsESvIBw2iFHlYdUd3M.cjzOzL5JNrhAX2OxyKBTKdwOS9ahC0S', NULL, NULL);
INSERT INTO super (rut) VALUES
    (20751584),
    (15871295),
    (13015354), 
    (1);
INSERT INTO contact (rut, subject, body) VALUES
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'),
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'),
    (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'),
    (20864127, 'Invitar colaboradores', 'Como se añaden compañeros a las tesis???');
INSERT INTO works (name, obj, area, abstract) VALUES
    ('Advanced Machine Learning Techniques', 'Development of a new machine learning algorithm', 'Machine Learning', 'This thesis explores advanced machine learning techniques and proposes a novel algorithm for improved predictive modeling.'),
    ('Secure Data Encryption in Cloud Computing', 'Enhancing data security in cloud environments', 'Cloud Computing', 'This research focuses on securing data in cloud computing environments by developing and implementing advanced encryption methods.'),
    ('Blockchain Technology in Supply Chain Management', 'Implementing blockchain for transparent supply chain', 'Blockchain', 'Examining the application of blockchain technology in supply chain management to enhance transparency and traceability.'),
    ('Human-Computer Interaction in Virtual Reality', 'Improving user experience in VR environments', 'Human-Computer Interaction', 'This thesis investigates the principles of human-computer interaction in virtual reality, aiming to enhance user experience and interaction design.'),
    ('Cybersecurity Threats and Mitigation Strategies', 'Analyzing and mitigating cybersecurity threats', 'Cybersecurity', 'An in-depth study of emerging cybersecurity threats and the development of effective mitigation strategies for protecting information systems.');
INSERT INTO workuser (rut, idWork) VALUES
    (15871295, 1),
    (20864127, 1),
    (8368745,  2),
    (20036002, 2),
    (15871295, 3),
    (21239226, 3),
    (13015354, 4),
    (20751584, 4),
    (13015354, 5),
    (21239226, 5);
INSERT INTO events (title, description, image, publicationDate, realizationDate) VALUES
    ('Feria científica, escolar y académica', 'Estacionamiento campus Romulo 3, Peña Maturana, Área Sur UDA', NULL, '2023-11-02', '2023-11-03'),
    ('Encuentro Recreativo-Deportivo UDA', 'Te invitamos al II Encuentro Deportivo UDA, donde la pasión y el espíritus deportivo, se unirán en un día lleno de energía y compañerismo. Este evento reunirá a estudiantes de enseñanza media de diversos establecimientos educacionales de la Región de Atacama.', NULL, '2023-11-14', '2023-11-17'),
    ('Forma parte del impulso empresarial: Ciclo Exclusivo de Charlas para Potenciar tus Conocimientos en Contratación, Impuestos e Inteligencia de Negocios', 'Orientadas a los estudiantes del Departamento de Administración y Gestión de la Facultad de Tecnología y la comunidad en general, con el fin de entregar conocimientos actualizados y nuevas herramientas que se están dando en el mercado.', NULL, '2023-11-24', '2023-11-28');