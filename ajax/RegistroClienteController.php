<?php include_once '../modelos/RegistroClienteModel.php';


//---Si se presiono un post a el boton que se llama "btnProcesar haga */

if(isset($_POST["btnGuardar"])){

    /**Esto seria para que se comunique la vista con el controlador */
    /**Lo que hacemos es capturar los valores de la vista */
    $Identificacion = $_POST["txtIdentificacion"];
    $Nombre = $_POST["txtNombre"];
    $Dirrecion= $_POST["txtDirrecion"];
    $Telefono =$_POST["txtTelefono"];
    
       /**Aqui le paso los parametros al Modelo Importante */
    $consulta = RegistroCliente( $Identificacion,$Nombre,$Dirrecion, $Telefono); /*Obtenemos la respuesta del modelo*/

    if( $consulta==true){

         //--- Se envia al login despues de registrarse---/

            header("location: clientes.php");


    }
    else{
         /**--- Aqui se envia un mensaje mediate POST al usuario en caso de no registrarse bien */
            $_POST["MSJ"] = "La informacion no a sido registrada correctamente , favor validar";
    }

}




?>