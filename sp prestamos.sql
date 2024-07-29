use prestamos 
-- sp para prestamos
DELIMITER //

CREATE PROCEDURE insertar_prestamo(
    IN p_idcliente INT,
    IN p_usuario VARCHAR(255),
    IN p_fprestamo DATE,
    IN p_monto DECIMAL(10,2),
    IN p_interes DECIMAL(5,2),
    IN p_saldo DECIMAL(10,2),
    IN p_formapago VARCHAR(255),
    IN p_fechapago DATE,
    IN p_plazo INT,
    IN p_fplazo DATE
)
BEGIN
    INSERT INTO prestamos (idcliente, usuario, fprestamo, monto, interes, saldo, formapago, fpago, plazo, fplazo, estado) 
    VALUES (p_idcliente, p_usuario, p_fprestamo, p_monto, p_interes, p_saldo, p_formapago, p_fechapago, p_plazo, p_fplazo, '1');
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE editar_prestamo(
    IN p_idprestamo INT,
    IN p_idcliente INT,
    IN p_usuario VARCHAR(255),
    IN p_fprestamo DATE,
    IN p_monto DECIMAL(10,2),
    IN p_interes DECIMAL(5,2),
    IN p_saldo DECIMAL(10,2),
    IN p_formapago VARCHAR(255),
    IN p_fechapago DATE,
    IN p_plazo INT,
    IN p_fplazo DATE
)
BEGIN
    UPDATE prestamos 
    SET idcliente = p_idcliente,
        usuario = p_usuario,
        fprestamo = p_fprestamo,
        monto = p_monto,
        interes = p_interes,
        saldo = p_saldo,
        formapago = p_formapago,
        fpago = p_fechapago,
        plazo = p_plazo,
        fplazo = p_fplazo
    WHERE idprestamo = p_idprestamo;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE eliminar_prestamo(
    IN p_idprestamo INT
)
BEGIN
    DELETE FROM prestamos WHERE idprestamo = p_idprestamo;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_cancelar_prestamo(
    IN p_idprestamo INT
)
BEGIN
    UPDATE prestamos SET estado = '0' WHERE idprestamo = p_idprestamo AND saldo = 0;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE mostrar_prestamo(
    IN p_idprestamo INT
)
BEGIN
    SELECT p.idprestamo, c.nombre AS cliente, u.nombre AS usuario, DATE(p.fprestamo) AS fecha, p.monto, p.interes, p.saldo, p.formapago, DATE(p.fpago) AS fechap, p.plazo, DATE(p.fplazo) AS fechaf, p.estado 
    FROM prestamos p 
    INNER JOIN clientes c ON p.idcliente = c.idcliente 
    INNER JOIN usuarios u ON p.usuario = u.idusuario 
    WHERE p.idprestamo = p_idprestamo;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE listar_prestamos()
BEGIN
    SELECT p.idprestamo, c.nombre AS cliente, u.nombre AS usuario, 
           DATE(p.fprestamo) AS fecha, p.monto, p.interes, p.saldo, 
           p.formapago, DATE(p.fpago) AS fechapago, p.plazo, 
           DATE(p.fplazo) AS fplazo, p.estado 
    FROM prestamos p 
    INNER JOIN clientes c ON p.idcliente = c.idcliente 
    INNER JOIN usuarios u ON p.usuario = u.idusuario;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE select_clientes_activos()
BEGIN
    SELECT DISTINCT c.cedula, c.idcliente 
    FROM prestamos p 
    INNER JOIN clientes c ON p.idcliente = c.idcliente 
    WHERE p.estado = 1;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE select_prestamos_por_cliente(
    IN p_idcliente INT
)
BEGIN
    SELECT monto, idprestamo 
    FROM prestamos 
    WHERE idcliente = p_idcliente AND estado = 1;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE traer_saldo(
    IN p_idprestamo INT
)
BEGIN
    SELECT saldo 
    FROM prestamos 
    WHERE idprestamo = p_idprestamo;
END //

DELIMITER ;

DELIMITER //


CREATE PROCEDURE actualizar_saldo(
    IN p_idprestamo INT,
    IN p_saldo DECIMAL(10,2)
)
BEGIN
    UPDATE prestamos 
    SET saldo = p_saldo 
    WHERE idprestamo = p_idprestamo;
END //

DELIMITER ;

-- sp listar permisos 
DELIMITER //

CREATE PROCEDURE listar_permisos()
BEGIN
    SELECT * FROM permisos;
END //

DELIMITER ;

-- Sp gastos
-- para insertar un registro
DELIMITER $$
CREATE PROCEDURE insertar_gasto(
    IN p_idusuario INT,
    IN p_fecha DATE,
    IN p_concepto VARCHAR(255),
    IN p_gasto DECIMAL(10, 2)
)
BEGIN
    INSERT INTO gastos (idusuario, fecha, concepto, gasto)
    VALUES (p_idusuario, p_fecha, p_concepto, p_gasto);
END$$
DELIMITER ;

-- Stored Procedure para editar un registro
DELIMITER $$
CREATE PROCEDURE editar_gasto(
    IN p_idgasto INT,
    IN p_idusuario INT,
    IN p_fecha DATE,
    IN p_concepto VARCHAR(255),
    IN p_gasto DECIMAL(10, 2)
)
BEGIN
    UPDATE gastos 
    SET idusuario = p_idusuario,
        fecha = p_fecha,
        concepto = p_concepto,
        gasto = p_gasto 
    WHERE idgasto = p_idgasto;
END$$
DELIMITER ;

-- Stored Procedure para eliminar un registro
DELIMITER $$
CREATE PROCEDURE eliminar_gasto(
    IN p_idgasto INT
)
BEGIN
    DELETE FROM gastos 
    WHERE idgasto = p_idgasto;
END$$
DELIMITER ;

-- Stored Procedure para mostrar un registro
DELIMITER $$
CREATE PROCEDURE mostrar_gasto(
    IN p_idgasto INT
)
BEGIN
    SELECT * 
    FROM gastos 
    WHERE idgasto = p_idgasto;
END$$
DELIMITER ;

-- Stored Procedure para listar todos los registros
DELIMITER $$
CREATE PROCEDURE listar_gastos()
BEGIN
    SELECT g.idgasto,
           g.idusuario,
           u.nombre AS Usuario, 
           g.fecha,
           g.concepto,
           g.gasto 
    FROM gastos g 
    INNER JOIN usuarios u 
    ON g.idusuario = u.idusuario;
END$$
DELIMITER ;

-- sp consultas
DELIMITER //

CREATE PROCEDURE compras_fecha(
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE
)
BEGIN
    SELECT DATE(i.fecha_hora) AS fecha,
           u.nombre AS usuario,
           p.nombre AS proveedor,
           i.tipo_comprobante,
           i.serie_comprobante,
           i.num_comprobante,
           i.total_compra,
           i.impuesto,
           i.estado 
    FROM ingreso i
    INNER JOIN persona p ON i.idproveedor = p.idpersona
    INNER JOIN usuario u ON i.idusuario = u.idusuario 
    WHERE DATE(i.fecha_hora) >= p_fecha_inicio 
      AND DATE(i.fecha_hora) <= p_fecha_fin;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ventas_fecha_cliente(
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE,
    IN p_idcliente INT
)
BEGIN
    SELECT DATE(v.fecha_hora) AS fecha,
           u.nombre AS usuario,
           p.nombre AS cliente,
           v.tipo_comprobante,
           v.serie_comprobante,
           v.num_comprobante,
           v.total_venta,
           v.impuesto,
           v.estado 
    FROM venta v
    INNER JOIN persona p ON v.idcliente = p.idpersona
    INNER JOIN usuario u ON v.idusuario = u.idusuario
    WHERE DATE(v.fecha_hora) >= p_fecha_inicio 
      AND DATE(v.fecha_hora) <= p_fecha_fin 
      AND v.idcliente = p_idcliente;
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE total_monto_hoy()
BEGIN
    SELECT IFNULL(SUM(monto), 0) AS total_montos 
    FROM prestamos 
    WHERE DATE(fprestamo) = CURDATE();
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE total_monto_hoy()
BEGIN
    SELECT IFNULL(SUM(monto), 0) AS total_montos 
    FROM prestamos 
    WHERE DATE(fprestamo) = CURDATE();
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE total_pagos_hoy()
BEGIN
    SELECT IFNULL(SUM(cuota), 0) AS total_pagos 
    FROM pagos 
    WHERE DATE(fecha) = CURDATE();
END //

DELIMITER ;
DELIMITER //

CREATE PROCEDURE sp_total_gasto_hoy()
BEGIN
    SELECT IFNULL(SUM(gasto), 0) AS total_gasto 
    FROM gastos 
    WHERE DATE(fecha) = CURDATE();
END //

DELIMITER ;


-- sp para pagos
DELIMITER //
CREATE PROCEDURE insertar_pago(
    IN p_idprestamo INT,
    IN p_usuario VARCHAR(50),
    IN p_fecha DATE,
    IN p_cuota DECIMAL(10,2)
)
BEGIN
    INSERT INTO pagos (idprestamo, usuario, fecha, cuota)
    VALUES (p_idprestamo, p_usuario, p_fecha, p_cuota);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE actualizar_pago(
    IN p_idpago INT,
    IN p_idprestamo INT,
    IN p_usuario VARCHAR(50),
    IN p_fecha DATE,
    IN p_cuota DECIMAL(10,2)
)
BEGIN
    UPDATE pagos 
    SET idprestamo = p_idprestamo,
        usuario = p_usuario,
        fecha = p_fecha,
        cuota = p_cuota
    WHERE idpago = p_idpago;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE eliminar_pago(
    IN p_idpago INT
)
BEGIN
    DELETE FROM pagos WHERE idpago = p_idpago;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE mostrar_pago(
    IN p_idpago INT
)
BEGIN
    SELECT c.nombre AS cliente, g.usuario, g.fecha, g.cuota
    FROM pagos g
    INNER JOIN prestamos p ON g.idprestamo = p.idprestamo
    INNER JOIN clientes c ON p.idcliente = c.idcliente
    WHERE g.idpago = p_idpago;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE listar_pagos()
BEGIN
    SELECT g.idpago, c.nombre AS cliente, g.usuario, g.fecha, g.cuota
    FROM pagos g
    INNER JOIN prestamos p ON g.idprestamo = p.idprestamo
    INNER JOIN clientes c ON p.idcliente = c.idcliente;
END //
DELIMITER ;




