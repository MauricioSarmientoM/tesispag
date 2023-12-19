from pymysql import connect
from enum import Enum
class OrderBy(Enum):
    ASC = 0
    DESC = 1
class DB():
    def __init__(self, host : str = 'localhost', user : str = 'root', password : str = '', database : str = '') -> None:
        try:
            self.connection = connect(
                host = host,
                user = user,
                password = password,
                database = database)
            self.cursor = self.connection.cursor()
            print('Connected Succesfully!')
        except:
            try:
                self.connection = connect(
                    host = host,
                    user = user,
                    password = password)
                self.cursor = self.connection.cursor()
                self.cursor.execute(f'CREATE DATABASE {database}')
                self.connection.commit()
                print(f'{database} created!')
                self.connection = connect(
                    host = host,
                    user = user,
                    password = password,
                    database = database)
                self.cursor = self.connection.cursor()
                #Hack to autocomplete the necessary stuff
                self.cursor.execute('CREATE TABLE users (rut INT NOT NULL UNIQUE PRIMARY KEY, name VARCHAR(128) NOT NULL, surname VARCHAR(128) NOT NULL, description VARCHAR(1000), email VARCHAR(128), phone INT, password VARCHAR(256) NOT NULL, imageURL VARCHAR(256), direction VARCHAR(128))')
                self.cursor.execute('CREATE TABLE usertutor (id INT UNIQUE AUTO_INCREMENT PRIMARY KEY, rut INT UNIQUE NOT NULL, grade VARCHAR(128), FOREIGN KEY (rut) REFERENCES users(rut))')
                self.cursor.execute('CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY, rut INT UNIQUE NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut))')
                self.cursor.execute('CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, subject VARCHAR(64) NOT NULL, body VARCHAR(1000), readed BOOLEAN, FOREIGN KEY (rut) REFERENCES users(rut))')
                self.cursor.execute('CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(256) NOT NULL, obj VARCHAR(256), area VARCHAR(128), abstract VARCHAR(2000), image VARCHAR(256))')
                self.cursor.execute("CREATE TABLE workuser (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, idWork INT NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut), FOREIGN KEY (idWork) REFERENCES works(id))")
                self.cursor.execute("CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(256) NOT NULL, description VARCHAR(1000), image VARCHAR(256), publicationDate DATE NOT NULL, realizationDate DATE)")
                self.cursor.execute("INSERT INTO users (rut, name, surname, email, password, direction) VALUES (20751584, 'Celeste', 'Marambio', 'celestemarmar2@gmail.com', '$2y$10$dmooAIPaTY80/rpajWPfsO/jEdFn8kMD03K6JhFhnhFPjcWgzujWG', 'Caburga 1105 Villa Arauco'), (15871295, 'Andrés', 'Alfaro', 'andres.alfaro@uda.cl', '$2y$10$C9ExGRnNn7VmsLM4FsFeU.GYOGCE5HODOAl3O9ik81qLtUUpDims.', 'Rio Copiapo 1591 V Valle De Los Rios'), (13015354, 'Héctor', 'Córnide', 'hector.cornide@uda.cl', '$2y$10$OqzqynOEHEbv3aKfdcjSmOkrhE6.RQ0BPC6i3wpC/ioGZt7UG.age', 'Salitrera Limeñita 2496 El Palomar'), (10198361, 'Dante', 'Carrizo', 'dante.carrizo@uda.cl', '$2y$10$GjY1gV/DdTjF73dLNvkc/uSz0uMHTyF.0v961E5sqjN5h3qxbpwga', 'Tte Merino 756 Pob Los Estandartes'), (12065689, 'Vladimir', 'Riffo', 'vladimir.riffo@uda.cl', '$2y$10$0H0lMfjU4byvK2KapAa.0OSVKKFgVOTP2OIu77REZAoirE0UllTx2', 'Sta Cruz 01792'), (11111111, 'John', 'Castro', 'john.castro@uda.cl', '$2y$10$cXEaL9THRKzmNMKh118SkuE78Hxm9TdVl/hg5CQao6p45j.psIz56' , ''), (18968842, 'Ignacio', 'Pizarro', '', '$2y$10$ma8Cc6URI1I5mYeM7AWYKOrMOQz7MJC49XKwKFAJR4JTNyr5SZVCG', 'Flora Normilla 1451 Padro Leon Gallo'), (16929207, 'Maiquel', 'Guerrero', '', '$2y$10$6oZVlFk0H7eupble7f8DXuTzNwn0mlfWvRx54qXwaLUVD5ni0dkhK', 'Caranpangue 1291 Balmaceda Norte'), (19356566, 'Rodolfo', 'Barraza', '', '$2y$10$kinfl.FPoAo7IdEHF/2W4e/IYULMO7PzMy.tfs54wYJpl7D/4FNlq', 'San Pedro 926 Villa Charles Bourg'), (19451494, 'Guisselle', 'Muñoz', '', '$2y$10$jUl36Esn6bUoNyFqW1bAdOK9MgW0rqXuWU36ZieUcxeCGYkgA0Tje', 'Sotomayor 1684'), (19460777, 'Gianina', 'Madrigal', '', '$2y$10$7dkUIBemZBzNn274G02zOOfjLi71niGmQCakjjzl4SsvzISGUOI2a', 'Portales 830'), (17762190, 'Rodrigo', 'Hidalgo', '', '$2y$10$toyOvkT7K7yYzqlLD4VzxunnrDp7bMdjXLwf0y/kGqAQPgAE16I5W', 'Covadonga 0311 Poblacion Ampliacion')")
                self.cursor.execute("INSERT INTO usertutor (rut) VALUES (15871295), (13015354), (10198361), (12065689), (11111111)")
                self.cursor.execute("INSERT INTO super (rut) VALUES (20751584), (15871295), (13015354)")
                self.cursor.execute("INSERT INTO works (name) VALUES ('Análisis del uso de los Sistemas Eye Tracking Como Apoyo en la Evaluación de Usabilidad'), ('Análisis y Especificación De Requisitos del Sistema Scot Para la Empresa Entel S.A'), ('Estudio Empirico Sobre el Efecto de un Software Para Facilitar Ajustes de Teléfonos Inteligentes en el Comportamiento'), ('Evaluación de Resultados de Aprendizaje en Ingeniería de Software, Utilizando la Analítica Multimodal del Aprendizaje y la Metodología Lego Serious Play'), ('Técnicas de Evaluación de Usabilidad Para Entornos Virtuales: Un Estudio Exploratorio'), ('Inspección Activa de Objetos para la Detección y Cuantificación del Volumen de un Eventual Daño, usando Reconstrucción 3D')")
                self.cursor.execute("INSERT INTO workuser (rut, idWork) VALUES (18968842, 1), (11111111, 1), (16929207, 2), (11111111, 2), (19356566, 3), (10198361, 3), (19451494, 4), (13015354, 4), (19460777, 5), (11111111, 5), (17762190, 6), (12065689, 6)")
                self.cursor.execute("INSERT INTO events (title, description, image, publicationDate, realizationDate) VALUES ('Feria científica, escolar y académica', 'Estacionamiento campus Romulo 3, Peña Maturana, Área Sur UDA', NULL, '2023-11-02', '2023-11-03'), ('Encuentro Recreativo-Deportivo UDA', 'Te invitamos al II Encuentro Deportivo UDA, donde la pasión y el espíritus deportivo, se unirán en un día lleno de energía y compañerismo. Este evento reunirá a estudiantes de enseñanza media de diversos establecimientos educacionales de la Región de Atacama.', NULL, '2023-11-14', '2023-11-17'), ('Forma parte del impulso empresarial: Ciclo Exclusivo de Charlas para Potenciar tus Conocimientos en Contratación, Impuestos e Inteligencia de Negocios', 'Orientadas a los estudiantes del Departamento de Administración y Gestión de la Facultad de Tecnología y la comunidad en general, con el fin de entregar conocimientos actualizados y nuevas herramientas que se están dando en el mercado.', NULL, '2023-11-24', '2023-11-28')")
                self.connection.commit()
                print('Connected Succesfully!')
            except ConnectionError as e:
                print(e)
    def DropDatabase(self, database):
        try:
            self.cursor.execute(f'DROP DATABASE {database}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
    def CreateTable(self, table : str = '', data : str = ''):
        try:
            data = f'({",".join(data.split(","))})'
            self.cursor.execute(f'CREATE TABLE {table} {data}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
    def DropTable(self, table):
        try:
            self.cursor.execute(f'DROP TABLE {table}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
    def InsertTable(self, table : str, column : str, values : list):
        try:
            if column != '': column = f' ({",".join(column.split(" "))})'
            values = [f'{i}' if not isinstance(i, str) else f'"{i}"' for i in values]
            data = f'({",".join(values)})'
            self.cursor.execute(f'INSERT INTO {table}{column} VALUES {data}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
    def Select(self, table : str, column : str = '', fetch : int = 1, where : str = '', orderBy : int = OrderBy.ASC, orderByColumn : str = ''):
        try:
            if column == '': column = '*'
            else: column = f'{",".join(column.split(" "))}'
            if where != '': where = f' WHERE {where}'
            if orderByColumn != '': orderByColumn = f' ORDER BY {",".join(orderByColumn.split(" "))} {orderBy.name}'
            self.cursor.execute(f'SELECT {column} FROM {table}{where}{orderByColumn}')
            if fetch < 1:
                return self.cursor.fetchall()
            elif fetch == 1:
                return self.cursor.fetchone()
            elif fetch > 1:
                return self.cursor.fetchmany(fetch)
        except Exception as e:
            print(e)
        return None
    def UpdateSet(self, table : str, column : str, values : list, where : str):
        try:
            if column != '': 
                data = [f'{j} = {k}' for j, k in zip(column.split(" "), [f'{i}' if not isinstance(i, str) else f'"{i}"' for i in values])]
                data = f'{",".join(data)}'
            if where != '': where = f' WHERE {",".join(where.split(","))}'
            self.cursor.execute(f'UPDATE {table} SET {data}{where}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
    def DeleteTable(self, table : str, where : str = ''):
        try:
            if where != '': where = f' WHERE {",".join(where.split(","))}'
            self.cursor.execute(f'DELETE FROM {table}{where}')
            self.connection.commit()
        except Exception as e:
            print(e)
        return self
def Main():
    db = DB(database = "tesis")
    print(db.Select('users', fetch = -1))
    #db.DropDatabase('tesis')
if __name__ == '__main__': Main()
