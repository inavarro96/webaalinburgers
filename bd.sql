CREATE DATABASE db_amburgesas;

use db_amburgesas;

alter table usuario add column fecha_baja date default null;
alter table producto add column fecha_alta date default null;
alter table producto add column precio decimal(11,5) default null;

create table producto (
	id int not null auto_increment primary key,
    nombre varchar(50),
    descripcion varchar(50),
    cantidad varchar(50),
    imagen varchar(50),
    fecha_baja date
);


create table usuario(
	id int not null auto_increment primary key,
    usuario varchar(50),
    password varchar(100),
    nombre varchar(100),
    apellidos varchar(100),
    perfil int,
    fecha_creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)


SELECT * FROM usuario WHERE fecha_baja IS NULL