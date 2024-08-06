<?php 
//Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";
    
Class Prestamo
{
    //implementamos nuestro constructor
    public function __construct()
    {   
    }
    
    //implementamos un metodo para insertar registros
    public function insertar($idcliente,$usuario,$fprestamo,$monto,$interes,$saldo,$formapago,$fechapago,$plazo,$fplazo)
    {
        $sql="INSERT INTO prestamos (idcliente,usuario,fprestamo,monto,interes,saldo,formapago,fpago,plazo,fplazo,estado) 
        VALUES ('$idcliente','$usuario','$fprestamo','$monto','$interes','$saldo','$formapago','$fechapago','$plazo','$fplazo','1')";
        return ejecutarConsulta($sql);
    }
    
    //Implementamos el metodo para Editar Registros
    public function editar($idprestamo,$idcliente,$usuario,$fprestamo,$monto,$interes,$saldo,$formapago,$fechapago,$plazo,$fplazo)
	{
		$sql="UPDATE prestamos SET 
                     idcliente='$idcliente',
                     usuario='$usuario',
                     fprestamo='$fprestamo',
                     monto='$monto',
                     interes='$interes',  
                     saldo='$saldo',
                     formapago='$formapago',
                     fpago='$fechapago',
                     plazo='$plazo',
                     fplazo='$fplazo' 
                    WHERE idprestamo='$idprestamo'";
		return ejecutarConsulta($sql);
	}
    
    //Implementamos un método para eliminar categorías
	public function eliminar($idprestamo)
	{
		$sql="DELETE FROM prestamos WHERE idprestamo='$idprestamo'";
		return ejecutarConsulta($sql);
	}
    
    //Implementamos un método para desactivar Clientes
	public function cancelado($idprestamo)
	{
		$sql="UPDATE prestamos SET estado ='0' WHERE SaldoActual=0";
		return ejecutarConsulta($sql);
	} 
    
    //Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idprestamo)
	{
		$sql="SELECT p.idprestamo,c.nombre as cliente,u.nombre as usuario,DATE(p.fprestamo) as fecha,p.monto,p.interes,p.saldo,p.formapago,DATE(p.fpago) as fechap,p.plazo,DATE(p.fplazo) as fechaf,p.estado 
        FROM prestamos p INNER JOIN clientes c ON 
        p.idcliente=c.idcliente INNER JOIN usuarios u ON 
        p.usuario=u.idusuario";
		return ejecutarConsultaSimpleFila($sql);
	}
    
//mostrar lista de la tabla gastos    
    public function listar()
	{
		$sql="SELECT p.idprestamo,c.nombre as cliente,u.nombre as usuario,DATE(p.fprestamo) as fecha,p.monto,p.interes,p.saldo,p.formapago,DATE(p.fpago) as fechap,p.plazo,DATE(p.fplazo) as fechaf,p.estado 
        FROM prestamos p INNER JOIN clientes c ON 
        p.idcliente=c.idcliente INNER JOIN usuarios u ON 
        p.usuario=u.idusuario";
		return ejecutarConsulta($sql);		
	}
    

    public function select()
	{
		$sql="SELECT distinct c.cedula, c.idcliente FROM prestamos p INNER JOIN clientes c ON p.idcliente=c.idcliente WHERE p.estado=1";
		return ejecutarConsulta($sql);		
	}

    public function selectPrestamosID($idcliente)
	{
		$sql="SELECT monto, idprestamo FROM prestamos WHERE idcliente = ".$idcliente." and estado=1";
		return ejecutarConsulta($sql);		
	}

    public function traerSaldo($idprestamo)
    {
        $sql="SELECT saldo FROM prestamos WHERE idprestamo = ".$idprestamo."";
        return ejecutarConsulta($sql);
    }

    public function actualizarSaldo($idprestamo, $saldo1)
    {
        $sql="UPDATE prestamos SET 
                     saldo='$saldo1'
                    WHERE idprestamo='$idprestamo'";
        return ejecutarConsulta($sql);
    }

}

?>