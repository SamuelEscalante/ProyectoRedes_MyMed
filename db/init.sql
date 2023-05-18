CREATE DATABASE inventariomymed;
USE inventariomymed;

CREATE TABLE usuarios (
    nombre varchar(255),
    usuario varchar(255),
    password varchar(255),
    jefe tinyint(1),
    primary key(nombre)

);

CREATE TABLE medicamentos (
    ID_MEDICAMENTO int(11) AUTO_INCREMENT,
    DESCRIPCION varchar(255) CHARACTER SET utf8,
    PRECIO_UNITARIO FLOAT(11),
    INVENTARIO int(11),
    primary key(ID_MEDICAMENTO)
);

CREATE TABLE compras (
    id int(11) auto_increment primary key,
    nombreCliente varchar(255),
    totalCuenta int(11),
    FechaCompra datetime default current_timestamp()
);

CREATE TABLE medicamentos_por_usuarios (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    medicamento_nombre VARCHAR(1000) CHARACTER SET utf8,
    cantidad INT,
    precio_total FLOAT,
    medicamento_id INT,
    compra_id INT
);

CREATE TABLE notificaciones (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    ID_MEDICAMENTO INT(11),
    DESCRIPCION VARCHAR(255) CHARACTER SET utf8,
    INVENTARIO VARCHAR(255),
    Fecha datetime default current_timestamp()
);


LOAD DATA INFILE '/var/lib/mysql-files/medicamentos_.csv'
INTO TABLE medicamentos
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ID_MEDICAMENTO, DESCRIPCION, PRECIO_UNITARIO, INVENTARIO);

LOAD DATA INFILE '/var/lib/mysql-files/usuarios.csv'
INTO TABLE usuarios
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(nombre, usuario, password, jefe);

LOAD DATA INFILE '/var/lib/mysql-files/compras.csv'
INTO TABLE compras
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(id,nombreCliente,totalCuenta,FechaCompra);