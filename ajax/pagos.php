<?php
require_once "../modelos/Pagos.php";
require_once "../modelos/Prestamos.php";
$pago=new Pago();
$prestamo = new Prestamo();
//Variables
$idpago=isset($_POST["idpago"])? limpiarCadena($_POST["idpago"]):"";
$idprestamo=isset($_POST["idprestamo"])? limpiarCadena($_POST["idprestamo"]):"";
$usuario=isset($_POST["usuario"])? limpiarCadena($_POST["usuario"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$cuota=isset($_POST["cuota"])? limpiarCadena($_POST["cuota"]):"";
$idprestamo2=isset($_POST["idprestamo2"])? limpiarCadena($_POST["idprestamo2"]):"";

switch($_GET["op"]){
        
    case 'guardaryeditar':
        if(empty($idpago)){
            $rspta=$pago->insertar($idprestamo2,$usuario,$fecha,$cuota);
            $consultaSaldo = $prestamo->traerSaldo($idprestamo2);
            $saldoPrestamo = 0;
            while ($reg = $consultaSaldo->fetch_object())
            {
                $saldoPrestamo = $reg->saldo;
            }
            $saldo1 = (float)$saldoPrestamo - (float)$cuota;
            $rsptaActualizar = $prestamo->actualizarSaldo((int)$idprestamo2, $saldo1);
            echo $rspta ? "Pago Registrado" : "Pago No se Pudo Registrar";
        }
        else
        {
          $rspta=$pago->editar($idpago,$idprestamo,$usuario,$fecha,$cuota);
            echo $rspta ? "Pago Actualizado" : "Pago no se pudo actualizar";
        }
    break;
        
    case 'eliminar':
        $rspta=$pago->eliminar($idpago);
        echo $rspta ? "Pago Eliminado" : "Pago no se puede eliminar";
    break;
        
    case 'mostrar':
        $rspta=$pago->mostrar($idpago);
        //Codificar resultado con json
        echo json_encode($idpago);
    break;
        
    case 'listar':
        $rspta=$pago->listar();
        //declaracion de array
        $data=Array();
        
        while ($reg=$rspta->fetch_object()){
            $data[]=array(
            "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpago.')"> <i class="fa fa-pencil"> </i></button>'.
 			    ' <button class="btn btn-danger" onclick="eliminar('.$reg->idpago.')"> <i class="fa fa-trash"> </i></button>',
            "1"=>$reg->cliente,
            "2"=>$reg->usuario,
            "3"=>$reg->fecha,
            "4"=>$reg->cuota);
        }
        $results = array(
        "sEcho"=>1, //Informacion para el datatables
            "iTotalRecords"=>count($data), //Enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //Enviamos el total de registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
    break;
        
    case 'selectPrestamo':
        require_once "../modelos/Prestamos.php";
		$prestamo = new Prestamo();
		$rspta = $prestamo->select();
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idcliente . '>' . $reg->cedula . '</option>';
        }
	break;

    case 'selectCuenta':
        require_once "../modelos/Prestamos.php";
		$prestamo = new Prestamo();
		$rspta = $prestamo->selectPrestamosID($idprestamo);
		while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idprestamo . '>' . $reg->monto . '</option>';
        }
	break;
}
?>