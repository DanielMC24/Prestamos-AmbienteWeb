<?php
//Incluimos la concexion a la base de datos.
require "../config/Conexion.php";

Class Pago
{
    public function __contruct()
    {   
    }

// Método para insertar registros
public function insertar($idprestamo, $usuario, $fecha, $cuota)
{
    global $conexion;
    $sql = "CALL insertar_pago(?, ?, ?, ?)";
    
    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param('issd', $idprestamo, $usuario, $fecha, $cuota);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error en la ejecución: " . $stmt->error;
        }
    } else {
        echo "Error en la preparación: " . $conexion->error;
    }
    
    return false;
}

// Método para editar registros
public function editar($idpago, $idprestamo, $usuario, $fecha, $cuota)
{
    global $conexion;
    $sql = "CALL actualizar_pago(?, ?, ?, ?, ?)";
    
    // Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {
        // Enlazar parámetros
        $stmt->bind_param('iissd', $idpago, $idprestamo, $usuario, $fecha, $cuota);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error en la ejecución: " . $stmt->error;
        }
    } else {
        echo "Error en la preparación: " . $conexion->error;
    }
    
    return false;
}

    // Método para eliminar registros
    public function eliminar($idpago)
    {
        global $conexion;
        $sql = "CALL eliminar_pago(?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('i', $idpago);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Error en la ejecución: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación: " . $conexion->error;
        }
        
        return false;
    }

    // Método para mostrar los datos de un registro
    public function mostrar($idpago)
    {
        global $conexion;
        $sql = "CALL mostrar_pago(?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('i', $idpago);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
                return $row;
            } else {
                echo "Error en la ejecución: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación: " . $conexion->error;
        }
        
        return null;
    }

    // Método para listar todos los registros
    public function listar()
    {
        global $conexion;
        $sql = "CALL listar_pagos()";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return $stmt->get_result(); // Devuelve el objeto de resultado
            } else {
                echo "Error en la ejecución: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación: " . $conexion->error;
        }
        
        return null; // Si hubo un error, retorna null
    }
}
?>