from pymysql import connect
from enum import Enum
class OrderBy(Enum):
    ASC = 0
    DESC = 1
class DB():
    def __init__(self, host : str = 'localhost', user : str = 'root', password : str = '12345678', database : str = 'tesis') -> None:
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
                self.cursor.execute('CREATE TABLE super (id INT AUTO_INCREMENT PRIMARY KEY, rut INT UNIQUE NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut))')
                self.cursor.execute('CREATE TABLE contact (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, subject VARCHAR(64) NOT NULL, body VARCHAR(1000), readed BOOLEAN, FOREIGN KEY (rut) REFERENCES users(rut))')
                self.cursor.execute('CREATE TABLE works (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(128) NOT NULL, obj VARCHAR(128), area VARCHAR(128), abstract VARCHAR(1000), image VARCHAR(256))')
                self.cursor.execute("CREATE TABLE workuser (id INT AUTO_INCREMENT PRIMARY KEY, rut INT NOT NULL, idWork INT NOT NULL, FOREIGN KEY (rut) REFERENCES users(rut), FOREIGN KEY (idWork) REFERENCES works(id))")
                self.cursor.execute("CREATE TABLE workfile (id INT AUTO_INCREMENT PRIMARY KEY, idWork INT NOT NULL, files VARCHAR(256), FOREIGN KEY (idWork) REFERENCES works(id))")
                self.cursor.execute("CREATE TABLE events (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(256) NOT NULL, description VARCHAR(1000), image VARCHAR(256), publicationDate DATE NOT NULL, realizationDate DATE)")
                self.cursor.execute("INSERT INTO users (rut, name, surname, description, email, phone, password, imageURL, direction) VALUES (20751584, 'Celeste', 'Marambio', NULL, 'celestemarmar2@gmail.com', 42707297, '$2y$10$dmooAIPaTY80/rpajWPfsO/jEdFn8kMD03K6JhFhnhFPjcWgzujWG', NULL, 'Caburga 1105 Villa Arauco'), (20036002, 'Javier', 'Ponce', NULL, NULL, NULL, '$2y$10$Q2/JWgpTVCcJ8LrJm2w2b.iwyqaHeRbvXpdUu.4k7aORQUEMxReNm', NULL, 'Los Carreras 3465 Villa Modelo'), (20864127, 'Gutemberg', 'Ávila', NULL, 'gutemberg.avila.21@alumnos.uda.cl', NULL, '$2y$10$fdLEEzEZ6zWRo/IQYx8mZeMyeQiUwhRDtOYu0PtBVqcdx4EkfnxS6', NULL, 'Aldunate 402'), (21239226, 'José', 'Herrera', NULL, 'jose.herrera.21@alumnos.uda.cl', NuLL, '$2y$10$GRh3DlflxWwBcw/U/U6yGOTEP2d8Nxf.n/gRP/VX/oznKjhE0BOQC', NULL, 'Guacolda 1062 Ampliacion Prat'), (15871295, 'Andrés', 'Alfaro', NULL, 'andres.alfaro@uda.cl', NULL, '$2y$10$C9ExGRnNn7VmsLM4FsFeU.GYOGCE5HODOAl3O9ik81qLtUUpDims.', NULL, 'Rio Copiapo 1591 V Valle De Los Rios'), (8368745, 'Manuel', 'Monasterio', NULL, 'manuel.monasterio@uda.cl', NULL, '$2y$10$6oZVlFk0H7eupble7f8DXuTzNwn0mlfWvRx54qXwaLUVD5ni0dkhK', NULL, 'Pj Jose O Valdivia 609 Ampl Los Sauces'), (13015354, 'Héctor', 'Córnide', NULL, 'hector.cornide@uda.cl', NULL, '$2y$10$OqzqynOEHEbv3aKfdcjSmOkrhE6.RQ0BPC6i3wpC/ioGZt7UG.age', NULL, 'Salitrera Limeñita 2496 El Palomar'), (1, 'root', 'user', NULL, NULL, NULL, '$2y$10$A4vsESvIBw2iFHlYdUd3M.cjzOzL5JNrhAX2OxyKBTKdwOS9ahC0S', NULL, NULL)")
                self.cursor.execute("INSERT INTO super (rut) VALUES (20751584), (15871295), (13015354), (1)")
                self.cursor.execute("INSERT INTO contact (rut, subject, body) VALUES (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'), (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'), (20864127, 'RECUPERAR CONTRASEÑA', 'Gutemberg Ávila parece haber olvidado su contraseña y pide que se le restaure.'), (20864127, 'Invitar colaboradores', 'Como se añaden compañeros a las tesis???')")
                self.cursor.execute("INSERT INTO works (name, obj, area, abstract) VALUES ('Advanced Machine Learning Techniques', 'Development of a new machine learning algorithm', 'Machine Learning', 'This thesis explores advanced machine learning techniques and proposes a novel algorithm for improved predictive modeling.'), ('Secure Data Encryption in Cloud Computing', 'Enhancing data security in cloud environments', 'Cloud Computing', 'This research focuses on securing data in cloud computing environments by developing and implementing advanced encryption methods.'), ('Blockchain Technology in Supply Chain Management', 'Implementing blockchain for transparent supply chain', 'Blockchain', 'Examining the application of blockchain technology in supply chain management to enhance transparency and traceability.'), ('Human-Computer Interaction in Virtual Reality', 'Improving user experience in VR environments', 'Human-Computer Interaction', 'This thesis investigates the principles of human-computer interaction in virtual reality, aiming to enhance user experience and interaction design.'), ('Cybersecurity Threats and Mitigation Strategies', 'Analyzing and mitigating cybersecurity threats', 'Cybersecurity', 'An in-depth study of emerging cybersecurity threats and the development of effective mitigation strategies for protecting information systems.')")
                self.cursor.execute("INSERT INTO workuser (rut, idWork) VALUES (15871295, 1), (20864127, 1), (8368745,  2), (20036002, 2), (15871295, 3), (21239226, 3), (13015354, 4), (20751584, 4), (13015354, 5), (21239226, 5)")
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
    db = DB(database = 'tesis')
    print(db.Select('users', fetch = -1))
    #db.DropDatabase('tesis')
if __name__ == '__main__': Main()
