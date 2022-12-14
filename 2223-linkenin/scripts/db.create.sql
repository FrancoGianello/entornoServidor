-- Active: 1673469115525@@127.0.0.1@3306@linkenin
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id int auto_increment PRIMARY KEY,
    nombre VARCHAR(255),
    passwd VARCHAR(255),
    img    VARCHAR(255),
    correo VARCHAR(255),
    descripcion TEXT
);

DROP TABLE IF EXISTS tokens;
CREATE TABLE tokens (
    id int auto_increment PRIMARY KEY,
    id_usuario int,
    valor VARCHAR(255),
    expiracion DATETIME,
    CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
