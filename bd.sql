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

-- nuevas tablas
create table pedido(
	id int not null auto_increment primary key,
	nombre_completo varchar(45), 
	direccion varchar(45), 
	telefono varchar(45), 
	visto TINYINT(1), 
	atendido TINYINT(1), 
	fecha_creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
	fecha_eliminado DATE default NULL
);

create table producto_pedido(
	id int not null auto_increment primary key,
	id_pedido INT not NULL, 
	id_producto INT not null,
	cantidad int default 0,
	INDEX(id_pedido),
	INDEX(id_producto),
	FOREIGN  key (id_pedido) references pedido(id),
	FOREIGN  key (id_producto) references producto(id)
);

create table notificacion (
	id int not null auto_increment primary key,
	asunto varchar(100),
	descripcion text,
	fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table notificacion_usuario(
	id int not null primary key auto_increment,
	fecha_visto DATE default null,
	id_notificacion int not null,
	id_usuario int not null,
	FOREIGN  key (id_notificacion) references notificacion(id),
	FOREIGN  key (id_usuario) references usuario(id)
);