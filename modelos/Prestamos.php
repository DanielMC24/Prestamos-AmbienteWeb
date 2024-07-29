<?php
require "../config/Conexion.php";

class Prestamo
{
    // Constructor
    public function __construct()
    {
    }

    // Método para insertar registros
    public function insertar($idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo)
    {
        global $conexion;
        $sql = "CALL insertar_prestamo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('iissdsssss', $idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo);
            
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
    public function editar($idprestamo, $idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo)
    {
        global $conexion;
        $sql = "CALL editar_prestamo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('iiissdsssss', $idprestamo, $idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo);
            
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
    public function eliminar($idprestamo)
    {
        global $conexion;
        $sql = "CALL eliminar_prestamo(?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('i', $idprestamo);
            
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

    // Método para cancelar registros
    public function cancelado($idprestamo)
    {
        global $conexion;
        $sql = "CALL sp_cancelar_prestamo(?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('i', $idprestamo);
            
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
    public function mostrar($idprestamo)
    {
        global $conexion;
        $sql = "CALL mostrar_prestamo(?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('i', $idprestamo);
            
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
        $sql = "CALL listar_prestamos()";
        
        if ($stmt = $conexion->prepare($sql)) {
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

    // Método para seleccionar clientes activos
    public function select()
    {
        global $conexion;
        $sql = "CALL select_clientes_activos()";
        
        if ($stmt = $conexion->prepare($sql)) {
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

    // Método para seleccionar préstamos por cliente
    public function selectPrestamosID($idcliente)
    {
        global $conexion;
        $sql = "CALL select_prestamos_por_cliente(?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('i', $idcliente);
            
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
    public function traerSaldo($idprestamo)
    {
        global $conexion;
        $sql = "CALL traer_saldo(?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('i', $idprestamo);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object(); // Usa fetch_object() en lugar de fetch_assoc()
                    $stmt->close();
                    return $row;
                } else {
                    echo "No se encontraron resultados.";
                }
            } else {
                echo "Error en la ejecución: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación: " . $conexion->error;
        }
        
        return null;
    }
    

    // Método para actualizar saldo
    public function actualizarSaldo($idprestamo, $saldo)
    {
        global $conexion;
        $sql = "CALL actualizar_saldo(?, ?)";
        
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param('id', $idprestamo, $saldo);
            
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
}
?>
