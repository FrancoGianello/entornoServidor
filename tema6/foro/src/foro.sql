DROP TABLE COMMENT CASCADE;
DROP TABLE POST CASCADE;
DROP TABLE TOKEN CASCADE;
DROP TABLE USER CASCADE;
DROP TABLE TEMA CASCADE;


CREATE TABLE TEMA(
    TEMA_NOMBRE varchar(255)PRIMARY KEY,
    DESCRIPCION varchar(255)
);


CREATE TABLE USER (
    ID_USER INT AUTO_INCREMENT PRIMARY KEY,
    USERNAME varchar(255) UNIQUE NOT NULL,
    PASS varchar(255) NOT NULL
);

CREATE TABLE POST (
    ID_POST INT AUTO_INCREMENT PRIMARY KEY,
    TEMA_NOMBRE varchar(255) NOT NULL,
    USERNAME varchar (255) NOT NULL,
    TITULO varchar(255) NOT NULL,
    CONTENIDO varchar(255) NOT NULL,
    CONSTRAINT FK_TEMA_NOMBRE FOREIGN KEY (TEMA_NOMBRE) REFERENCES TEMA(TEMA_NOMBRE),
    CONSTRAINT FK_USERNAME FOREIGN KEY (USERNAME) REFERENCES USER(USERNAME)
);

CREATE TABLE COMMENT(
    ID_COMMENT INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_POST INT NOT NULL,
    CONTENIDO varchar(500) NOT NULL,
    USERNAME varchar(255) NOT NULL,
    CONSTRAINT FK_POST FOREIGN KEY (ID_POST) REFERENCES POST(ID_POST),
    CONSTRAINT FK_USER_COMMENT FOREIGN KEY (USERNAME) REFERENCES USER(USERNAME)
);
--CAMBIAR LA PK PARA TENER EL AUTOINCREMENT EN UNA PK CONJUNTA
ALTER TABLE COMMENT DROP PRIMARY KEY, ADD PRIMARY KEY(ID_COMMENT, ID_POST);
CREATE TABLE TOKEN (
    ID_TOKEN int auto_increment PRIMARY KEY,
    ID_USER int,
    VALOR VARCHAR(255),
    EXPIRACION DATETIME NOT NULL DEFAULT (NOW() + INTERVAL 7 DAY),
    CONSTRAINT FK_ID_USER_TOKEN FOREIGN KEY (ID_USER) REFERENCES USER(ID_USER)
);


--INSERTS DE TEMAS ARBITRARIOS
INSERT INTO TEMA VALUES("DEPORTES", "ACTIVIDADES Y COMPETICIONES FISICAS");
INSERT INTO TEMA VALUES("SHOWERLESS", "MANGA Y ANIME");
INSERT INTO TEMA VALUES("GAMING", "GAMING TIME");
INSERT INTO TEMA VALUES("OTROS", "NOSE");