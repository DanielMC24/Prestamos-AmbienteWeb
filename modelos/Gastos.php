<?php
require "../config/Conexion.php";

Class Gastos
{
    // Constructor
    public function __construct()
    {   
    }

    // Método para insertar registros
    public function insertar($idusuario, $fecha, $concepto, $gasto)
    {
        global $conexion;
        $sql = "CALL insertar_gasto(?, ?, ?, ?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('issd', $idusuario, $fecha, $concepto, $gasto);
            
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
    public function editar($idgasto, $idusuario, $fecha, $concepto, $gasto)
    {
        global $conexion;
        $sql = "CALL editar_gasto(?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('iissd', $idgasto, $idusuario, $fecha, $concepto, $gasto);
            
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
    public function eliminar($idgasto)
    {
        global $conexion;
        $sql = "CALL eliminar_gasto(?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('i', $idgasto);
            
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
    public function mostrar($idgasto)
    {
        global $conexion;
        $sql = "CALL mostrar_gasto(?)";
        
        // Preparar la consulta
        if ($stmt = $conexion->prepare($sql)) {
            // Enlazar parámetros
            $stmt->bind_param('i', $idgasto);
            
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
    $sql = "CALL listar_gastos()";
    
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
