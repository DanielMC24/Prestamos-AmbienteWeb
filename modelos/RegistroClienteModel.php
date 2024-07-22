<?php include_once '../config/Conexion.php';


function RegistroCliente( $Identificacion,$Nombre,$Dirrecion,$Telefono)
{
    //Abrimos la connection //
    $Connection = AbrirBD();
 // Llamado a la base de datos, se pone "call y el nombre del procedimeinto almacenado"//
    $judgment = "CALL RegistroCliente('$Identificacion','$Nombre','$Dirrecion','$Telefono')";
    //Procesa el procedimiento almacenado.
    $respuesta = $Connection ->query($judgment);
    //Cierro la BD
    CerrarBD($Connection);

    return  $respuesta;
    
}

?>