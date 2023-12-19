CREATE DATABASE tesis;
CREATE TABLE users (rut INT NOT NULL UNIQUE PRIMARY KEY, name VARCHAR(128) NOT NULL, surname VARCHAR(128) NOT NULL, description VARCHAR(1000), email VARCHAR(128), phone INT, password VARCHAR(256) NOT NULL, imageURL VARCHAR(256), direction VARCHAR(128));
CREATE TABLE usertutor (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, rut INT UNIQUE NOT NULL, grade VARCHAR(128), FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY, rut INT UNIQUE NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, subject VARCHAR(64) NOT NULL, body VARCHAR(1000), readed BOOLEAN, FOREIGN KEY (rut) REFERENCES users(rut));
CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(128) NOT NULL, obj VARCHAR(128), area VARCHAR(128), abstract VARCHAR(1000), image VARCHAR(256));
CREATE TABLE workuser (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, idWork INT NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut), FOREIGN KEY (idWork) REFERENCES works(id));
CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(256) NOT NULL, description VARCHAR(1000), image VARCHAR(256), publicationDate DATE NOT NULL, realizationDate DATE);
INSERT INTO users (rut, name, surname, email, password, direction) VALUES
    (20751584, 'Celeste', 'Marambio', 'celestemarmar2@gmail.com', '$2y$10$dmooAIPaTY80/rpajWPfsO/jEdFn8kMD03K6JhFhnhFPjcWgzujWG', 'Caburga 1105 Villa Arauco'),
    (15871295, 'Andrés', 'Alfaro', 'andres.alfaro@uda.cl', '$2y$10$C9ExGRnNn7VmsLM4FsFeU.GYOGCE5HODOAl3O9ik81qLtUUpDims.', 'Rio Copiapo 1591 V Valle De Los Rios'),
    (8368745, 'Manuel', 'Monasterio', 'manuel.monasterio@uda.cl', '$2y$10$6oZVlFk0H7eupble7f8DXuTzNwn0mlfWvRx54qXwaLUVD5ni0dkhK', 'Pj Jose O Valdivia 609 Ampl Los Sauces'),
    (13015354, 'Héctor', 'Córnide', 'hector.cornide@uda.cl', '$2y$10$OqzqynOEHEbv3aKfdcjSmOkrhE6.RQ0BPC6i3wpC/ioGZt7UG.age', 'Salitrera Limeñita 2496 El Palomar'),
    (10198361, 'Dante', 'Carrizo', 'dante.carrizo@uda.cl', '$2y$10$GjY1gV/DdTjF73dLNvkc/uSz0uMHTyF.0v961E5sqjN5h3qxbpwga', 'Tte Merino 756 Pob Los Estandartes'),
    (12065689, 'Vladimir', 'Riffo', 'vladimir.riffo@uda.cl', '$2y$10$0H0lMfjU4byvK2KapAa.0OSVKKFgVOTP2OIu77REZAoirE0UllTx2', 'Sta Cruz 01792'),
    (, 'John', 'Castro', 'john.castro@uda.cl', ''),
    (21401814, 'Ignacio', 'Pizarro',);
INSERT INTO super (rut) VALUES (20751584), (15871295), (13015354);
INSERT INTO works (name) VALUES ('Análisis del uso de los Sistemas Eye Tracking Como Apoyo en la Evaluación de Usabilidad'), ('Análisis y Especificación De Requisitos del Sistema Scot Para la Empresa Entel S.A'), ('Estudio Empirico Sobre el Efecto de un Software Para Facilitar Ajustes de Teléfonos Inteligentes en el Comportamiento'), ('Evaluación de Resultados de Aprendizaje en Ingeniería de Software, Utilizando la Analítica Multimodal del Aprendizaje y la Metodología Lego Serious Play'), ('Técnicas de Evaluación de Usabilidad Para Entornos Virtuales: Un Estudio Exploratorio'), ('Inspección Activa de Objetos para la Detección y Cuantificación del Volumen de un Eventual Daño, usando Reconstrucción 3D');
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