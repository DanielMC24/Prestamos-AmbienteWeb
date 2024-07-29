<?php 
// Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permisos
{
    // Implementamos nuestro constructor
    public function __construct()
    {
    }

    // Implementar un método para listar los registros
    public function listar()
    {
        global $conexion;
        $sql = "CALL listar_permisos()";
        
        if ($stmt = $conexion->prepare($sql)) {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $data = [];

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                
                $stmt->close();
                return $data;
            } else {
                echo "Error en la ejecución: " . $stmt->error;
            }
        } else {
            echo "Error en la preparación: " . $conexion->error;
        }
        
        return [];
    }
}
?>
