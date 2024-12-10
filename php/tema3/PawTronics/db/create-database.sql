--
-- Base de datos: `ventas_comerciales`
--
CREATE DATABASE IF NOT EXISTS `ventas_comerciales` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `ventas_comerciales`;

--
-- Estructura de las tablas
--
create table IF NOT EXISTS Comerciales (
    codigo		varchar(3) primary key,
    nombre		varchar(30) not null,
    salario		float not null,
    hijos		int not null,
    fNacimiento	date not null
    );

create table IF NOT EXISTS Productos (
    referencia		varchar(6) primary key,
    nombre		varchar(20) not null,
    descripcion	varchar(20),
    precio		float not null,
    descuento	int not null
    );


create table IF NOT EXISTS Ventas (
    codComercial	varchar(3),
    refProducto		varchar(6),
    cantidad		int,
    fecha			date,
    primary key (codComercial, refProducto, fecha),
    foreign key (codComercial) references Comerciales(codigo),
    foreign key (refProducto) references Productos(referencia)
    );
