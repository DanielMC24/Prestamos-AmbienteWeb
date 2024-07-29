<?php
require_once "../modelos/Pagos.php";
require_once "../modelos/Prestamos.php";

$pago = new Pago();
$prestamo = new Prestamo();

// Variables
$idpago = isset($_POST["idpago"]) ? limpiarCadena($_POST["idpago"]) : "";
$idprestamo = isset($_POST["idprestamo"]) ? limpiarCadena($_POST["idprestamo"]) : "";
$usuario = isset($_POST["usuario"]) ? limpiarCadena($_POST["usuario"]) : "";
$fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]) : "";
$cuota = isset($_POST["cuota"]) ? limpiarCadena($_POST["cuota"]) : "";
$idprestamo2 = isset($_POST["idprestamo2"]) ? limpiarCadena($_POST["idprestamo2"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idpago)) {
            // Inserción de un nuevo pago
            $rspta = $pago->insertar($idprestamo2, $usuario, $fecha, $cuota);
            if ($rspta) {
                // Actualización del saldo del préstamo
                $consultaSaldo = $prestamo->traerSaldo($idprestamo2);
                $saldoPrestamo = 0;
                while ($reg = $consultaSaldo->fetch_object()) {
                    $saldoPrestamo = $reg->saldo;
                }
                $saldo1 = (float)$saldoPrestamo - (float)$cuota;
                $rsptaActualizar = $prestamo->actualizarSaldo((int)$idprestamo2, $saldo1);
                echo $rsptaActualizar ? "Pago registrado y saldo actualizado" : "Pago registrado pero no se pudo actualizar el saldo";
            } else {
                echo "Pago no se pudo registrar";
            }
        } else {
            // Edición de un pago existente
            $rspta = $pago->editar($idpago, $idprestamo, $usuario, $fecha, $cuota);
            echo $rspta ? "Pago actualizado" : "Pago no se pudo actualizar";
        }
        break;

    case 'eliminar':
        $rspta = $pago->eliminar($idpago);
        echo $rspta ? "Pago eliminado" : "Pago no se pudo eliminar";
        break;

    case 'mostrar':
        $rspta = $pago->mostrar($idpago);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $pago->listar();
        $data = array();

        if ($rspta) { // Verifica si la respuesta es válida
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->idpago . ')"><i class="fa fa-pencil"></i></button>' .
                           ' <button class="btn btn-danger" onclick="eliminar(' . $reg->idpago . ')"><i class="fa fa-trash"></i></button>',
                    "1" => $reg->cliente,
                    "2" => $reg->usuario,
                    "3" => $reg->fecha,
                    "4" => $reg->cuota
                );
            }

            $results = array(
                "sEcho" => 1, // Información para el datatables
                "iTotalRecords" => count($data), // Enviamos el total de registros al datatable
                "iTotalDisplayRecords" => count($data), // Enviamos el total de registros a visualizar
                "aaData" => $data
            );
            echo json_encode($results);
        } else {
            echo json_encode(array("error" => "No se pudo obtener los datos."));
        }
        break;

    case "selectPrestamo":
        require_once "../modelos/Prestamos.php";
        $prestamo = new Prestamo();
        $rspta = $prestamo->select();
        
        if ($rspta) {
            while ($reg = $rspta->fetch_object()) {
                echo '<option value="' . $reg->idprestamo . '">' . $reg->nombre . '</option>';
            }
        } else {
            echo '<option value="">No hay datos disponibles</option>';
        }
        break;

    case "selectCuenta":
        require_once "../modelos/Prestamos.php";
        $prestamo = new Prestamo();
        $rspta = $prestamo->selectPrestamosID($idprestamo);
        
        if ($rspta) {
            while ($reg = $rspta->fetch_object()) {
                echo '<option value="' . $reg->idcuenta . '">' . $reg->descripcion . '</option>';
            }
        } else {
            echo '<option value="">No hay datos disponibles</option>';
        }
        break;
}
?>
