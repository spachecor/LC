create database if not exists ventas_comerciales;

use ventas_comerciales;

create table if not exists Comerciales (
    codigo		varchar(3) primary key,
    nombre		varchar(30) not null,
    salario		float not null,
    hijos		int not null,
    fNacimiento	date not null
);

create table if not exists Productos (
    referencia	varchar(6) primary key,
    nombre		varchar(20) not null,
    descripcion	varchar(20),
    precio		float not null,
    descuento	int not null
);


create table if not exists Ventas (
    codComercial	varchar(3),
    refProducto		varchar(6),
    cantidad		int,
    fecha			date,
    primary key (codComercial, refProducto, fecha),
    foreign key (codComercial) references Comerciales(codigo),
    foreign key (refProducto) references Productos(referencia)
);