create database ipe;
use ipe;

create table Usuarios(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    tipo tinyint not null,
    email varchar(255),
    password VARCHAR(255) NOT NULL,
    dni int(45),
    direccion varchar(255),
    numero int(100),
    edad int(20)
);

create table Inscripciones(
id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
estado varchar(255)
);

CREATE TABLE InscripcionesUsuarios (
    id_usuario INT,
    id_inscripcion INT,
    PRIMARY KEY (id_usuario, id_inscripcion),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_inscripcion) REFERENCES Inscripciones(id_inscripcion)
)

SELECT * FROM Inscripciones ORDER BY id_inscripcion DESC LIMIT 1