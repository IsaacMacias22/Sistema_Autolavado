CREATE DATABASE autolavado_bimbunuelos;
USE autolavado_bimbunuelos;

CREATE TABLE usuarios(
idUsuario INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
usuario VARCHAR(50) NOT NULL,
contrasena VARCHAR(300) NOT NULL,
rol ENUM('Administrador', 'Operador') NOT NULL
);

CREATE TABLE clientes(
idCliente INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
telefono VARCHAR(15) NOT NULL UNIQUE,
correo VARCHAR(100) NOT NULL
);

CREATE TABLE tipos(
idTipo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
descripcion VARCHAR(50) NOT NULL,
costo DOUBLE NOT NULL,
observacion VARCHAR(50) NOT NULL
);

CREATE TABLE vehiculos(
idVehiculo INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
marca VARCHAR(50) NOT NULL,
modelo VARCHAR(50) NOT NULL,
anio VARCHAR(10) NOT NULL,
color VARCHAR(20) NOT NULL,
placas VARCHAR(10) NOT NULL UNIQUE,
imagen VARCHAR(200) NOT NULL UNIQUE,
observacion DOUBLE NOT NULL,
fkIdCliente INT NOT NULL,	
fkIdTipo INT NOT NULL,
FOREIGN KEY(fkIdCliente) REFERENCES clientes(idCliente),
FOREIGN KEY(fkIdTipo) REFERENCES tipos(idTipo)	
);


CREATE TABLE empleados(
idEmpleado INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
apellidos VARCHAR(100) NOT NULL,
telefono VARCHAR(15) NOT NULL UNIQUE,
correo VARCHAR(100) NOT NULL UNIQUE,
porcentaje DOUBLE NOT NULL,
imagen VARCHAR(200) NOT NULL UNIQUE	
);

CREATE TABLE turnos(
idTurno INT,
costo DOUBLE NOT NULL,
fecha DATE NOT NULL,
estatus VARCHAR(50),
fkIdCliente INT NOT NULL,
fkIdVehiculo INT NOT NULL,
fkIdEmpleado INT NOT NULL,
PRIMARY KEY(idTurno, fecha),
FOREIGN KEY(fkIdCliente) REFERENCES clientes(idCliente),
FOREIGN KEY(fkIdVehiculo) REFERENCES vehiculos(idVehiculo),
FOREIGN KEY(fkIdEmpleado) REFERENCES empleados(idEmpleado)
);

delimiter ;;
DROP PROCEDURE if EXISTS p_insertar_modificarClientes;
CREATE PROCEDURE p_insertar_modificarClientes(
IN p_idCliente INT,
IN p_nombre VARCHAR(100),
IN p_telefono VARCHAR(15),
IN p_correo VARCHAR(100)
)
BEGIN
	if p_idCliente = -1 then
		INSERT INTO clientes VALUES(NULL, p_nombre, p_telefono, p_correo);
	ELSE if p_idCliente > 0 then
		UPDATE clientes SET nombre = p_nombre, telefono = p_telefono, correo = p_correo
		WHERE idCliente = p_idCliente;
	END if;
	END if;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_insertar_modificarEmpleados;
CREATE PROCEDURE p_insertar_modificarEmpleados(
IN p_idEmpleado INT,
IN p_nombre VARCHAR(100),
IN p_apellidos VARCHAR(100),
IN p_telefono VARCHAR(15),
IN p_correo VARCHAR(100),
IN p_porcentaje DOUBLE,
IN p_imagen VARCHAR(200)
)
BEGIN
	if p_idEmpleado = -1 then
		INSERT INTO empleados VALUES(NULL, p_nombre, p_apellidos, p_telefono, p_correo, p_porcentaje, p_imagen);
	ELSE if p_idEmpleado > 0 then
		UPDATE empleados SET nombre = p_nombre, apellidos = p_apellidos, telefono = p_telefono, correo = p_correo,
		porcentaje = p_porcentaje, imagen = p_imagen
		WHERE idEmpleado = p_idEmpleado;
	END if;
	END if;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_insertar_modificarTipos;
CREATE PROCEDURE p_insertar_modificarTipos(
IN p_idTipo INT,
IN p_costo DOUBLE
)
BEGIN
	if p_idTipo > 0 then
		UPDATE tipos SET costo = p_costo
		WHERE idTipo = p_idTipo;
	END if;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_insertar_modificarVehiculos;
CREATE PROCEDURE p_insertar_modificarVehiculos(
IN p_idVehiculo INT,
IN p_marca VARCHAR(50),
IN p_modelo VARCHAR(50),
IN p_anio VARCHAR(10),
IN p_color VARCHAR(20),
IN p_placas VARCHAR(10),
IN p_imagen VARCHAR(200),
IN p_observacion DOUBLE,
IN p_fkIdCliente INT,	
IN p_fkIdTipo INT
)
BEGIN
	if p_idVehiculo = -1 then
		INSERT INTO vehiculos VALUES(NULL, p_marca, p_modelo, p_anio, p_color, p_placas, p_imagen, p_observacion, p_fkIdCliente, p_fkIdTipo);
	ELSE if p_idVehiculo > 0 then
		UPDATE vehiculos SET 
		marca = p_marca, modelo = p_modelo, anio = p_anio, color = p_color, placas = p_placas, imagen = p_imagen, 
		observacion = p_observacion, fkIdCliente = p_fkIdCliente
		WHERE idVehiculo = p_idVehiculo;
	END if;
	END if;
END;;


delimiter ;;
DROP PROCEDURE if EXISTS p_insertar_modificarTurnos;
CREATE PROCEDURE p_insertar_modificarTurnos(
IN p_idTurno INT,
IN p_costo DOUBLE,
IN p_fecha DATE,
IN p_estatus VARCHAR(50),
IN p_fkIdCliente INT,
IN p_fkIdVehiculo INT,
IN p_fkIdEmpleado INT
)
BEGIN
	DECLARE X INT;
	DECLARE P DOUBLE;
	if p_idTurno = -1 then
		SELECT COUNT(fecha) FROM turnos WHERE fecha = p_fecha INTO X;
		SELECT empleados.porcentaje FROM empleados WHERE empleados.idEmpleado = p_fkIdEmpleado INTO P;
		INSERT INTO turnos VALUES(X+1, p_costo, p_fecha, p_estatus, p_fkIdCliente, p_fkIdVehiculo, p_fkIdEmpleado, P);
	END if;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrarVehiculos;
CREATE PROCEDURE p_mostrarVehiculos(
IN p_filtro VARCHAR(100)
)
BEGIN
	SELECT v.idVehiculo, t.descripcion, v.marca, v.modelo, v.anio, v.color, v.placas, v.imagen, c.nombre AS cliente
	FROM vehiculos AS v
	INNER JOIN clientes AS c ON v.fkIdCliente = c.idCliente
	INNER JOIN tipos AS t ON v.fkIdTipo = t.idTipo
	WHERE 
	   v.marca LIKE p_filtro 
	   OR v.modelo LIKE p_filtro 
	   OR v.placas LIKE p_filtro 
	   OR t.descripcion LIKE p_filtro 
	   OR c.nombre LIKE p_filtro;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrarVehiculosYClientes;
CREATE PROCEDURE p_mostrarVehiculosYClientes(
IN p_idVehiculo INT
)
BEGIN
	SELECT * FROM vehiculos
	INNER JOIN clientes ON vehiculos.fkIdCliente = clientes.idCliente
	WHERE idVehiculo = p_idVehiculo;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrarCostos;
CREATE PROCEDURE p_mostrarCostos(
IN p_idVehiculo INT
)
BEGIN
	SELECT v.idVehiculo, t.costo AS unitario, v.observacion AS aux, t.costo * v.observacion AS costoTotal
	FROM vehiculos AS v
	INNER JOIN tipos AS t ON v.fkIdTipo = t.idTipo
	WHERE v.idVehiculo = p_idVehiculo;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrar_vehiculos_lavados;
CREATE PROCEDURE p_mostrar_vehiculos_lavados(
IN p_fecha DATE
)
BEGIN
	SELECT e.idEmpleado AS numeroempleado, CONCAT(e.nombre, ' ', e.apellidos) AS nombreempleado, 
	COUNT(t.idTurno) AS autoslavados, SUM(t.costo) AS montocobrado, t.porcentaje, ((t.porcentaje / 100) * SUM(t.costo)) AS montoganado,
	(SUM(t.costo) - ((t.porcentaje / 100) * SUM(t.costo))) AS gananciagenerada
	FROM turnos AS t
	INNER JOIN empleados AS e ON t.fkIdEmpleado = e.idEmpleado
	WHERE t.fecha = p_fecha AND t.estatus = 'Concluido'
	GROUP BY e.idEmpleado, t.porcentaje;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrar_cantidad_vehiculos_maximo;
CREATE PROCEDURE p_mostrar_cantidad_vehiculos_maximo(
IN p_fecha DATE
)
BEGIN
	SELECT e.idEmpleado AS numeroempleado, CONCAT(e.nombre, ' ', e.apellidos) AS nombreempleado,
	COUNT(t.idTurno) AS autoslavados, e.imagen
	FROM turnos AS t
	INNER JOIN empleados AS e ON t.fkIdEmpleado = e.idEmpleado
	WHERE t.fecha = p_fecha AND t.estatus = 'Concluido'
	GROUP BY e.idEmpleado ORDER BY autoslavados DESC LIMIT 1;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrar_cantidad_vehiculos_todos;
CREATE PROCEDURE p_mostrar_cantidad_vehiculos_todos(
IN p_fkIdEmpleado INT,
IN p_fecha DATE
)
BEGIN
	SELECT v.imagen, CONCAT(v.marca, ' ', v.modelo, ' ', v.anio, ' ', v.color) AS vehiculo,
	c.nombre AS cliente, t.costo AS cobro
	FROM turnos AS t
	INNER JOIN empleados AS e ON t.fkIdEmpleado = e.idEmpleado
	INNER JOIN vehiculos AS v ON t.fkIdVehiculo = v.idVehiculo
	INNER JOIN clientes AS c ON t.fkIdCliente = c.idCliente
	WHERE t.fecha = p_fecha AND t.estatus = 'Concluido' AND t.fkIdEmpleado = p_fkIdEmpleado;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrar_clientes_atendidos;
CREATE PROCEDURE p_mostrar_clientes_atendidos(
IN p_fechaInicio DATE,
IN p_fechaFin DATE
)
BEGIN
	SELECT c.nombre AS cliente, COUNT(t.idTurno) AS numeroservicios
	FROM turnos AS t
	INNER JOIN clientes AS c ON t.fkIdCliente = c.idCliente
	INNER JOIN vehiculos AS v ON t.fkIdVehiculo = v.idVehiculo
	WHERE t.fecha BETWEEN p_fechaInicio AND p_fechaFin
	GROUP BY cliente ORDER BY numeroservicios DESC;
END;;

delimiter ;;
DROP PROCEDURE if EXISTS p_mostrar_clientes_atendidos_desglose;
CREATE PROCEDURE p_mostrar_clientes_atendidos_desglose(
IN p_fechaInicio DATE,
IN p_fechaFin DATE
)
BEGIN
	SELECT c.nombre AS cliente, CONCAT(v.marca, ' ', v.modelo, ' ', v.anio, ' ', v.color) AS vehiculo, 
	v.imagen AS imagen, COUNT(t.idTurno) AS numeroservicios
	FROM turnos AS t
	INNER JOIN clientes AS c ON t.fkIdCliente = c.idCliente
	INNER JOIN vehiculos AS v ON t.fkIdVehiculo = v.idVehiculo
	WHERE t.fecha BETWEEN p_fechaInicio AND p_fechaFin
	GROUP BY vehiculo, imagen, cliente ORDER BY cliente, numeroservicios DESC;
END;;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'EF797C8118F02DFB649607DD5D3F8C7623048C9C063D532CC95C5ED7A898A64F', 1);
INSERT INTO usuarios VALUES(NULL, 'Operador', '5994471ABB01112AFCC18159F6CC74B4F511B99806DA59B3CAF5A9C173CACFC5', 2);

INSERT INTO tipos VALUES(NULL, 'Automóvil', 100, 'Cobro por pieza');
INSERT INTO tipos VALUES(NULL, 'Camioneta', 50, 'Cobro por número de puertas');
INSERT INTO tipos VALUES(NULL, 'Tracto camión', 55, 'Cobro por longitud (metros)');