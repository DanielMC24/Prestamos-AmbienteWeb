<?php
// Incluir el archivo de configuración de conexión
require_once "../modelos/Prestamos.php";

// Crear una instancia de la clase Prestamo
$prestamo = new Prestamo();

// Limpiar y obtener los datos de la solicitud
$idprestamo = isset($_POST["idprestamo"]) ? limpiarCadena($_POST["idprestamo"]) : "";
$idcliente = isset($_POST["idcliente"]) ? limpiarCadena($_POST["idcliente"]) : "";
$usuario = isset($_POST["usuario"]) ? limpiarCadena($_POST["usuario"]) : "";
$fprestamo = isset($_POST["fprestamo"]) ? limpiarCadena($_POST["fprestamo"]) : "";
$monto = isset($_POST["monto"]) ? limpiarCadena($_POST["monto"]) : "";
$interes = isset($_POST["interes"]) ? limpiarCadena($_POST["interes"]) : "";
$saldo = isset($_POST["saldo"]) ? limpiarCadena($_POST["saldo"]) : "";
$formapago = isset($_POST["formapago"]) ? limpiarCadena($_POST["formapago"]) : "";
$fechapago = isset($_POST["fechapago"]) ? limpiarCadena($_POST["fechapago"]) : "";
$plazo = isset($_POST["plazo"]) ? limpiarCadena($_POST["plazo"]) : "";
$fplazo = isset($_POST["fplazo"]) ? limpiarCadena($_POST["fplazo"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idprestamo)) {
            // Insertar nuevo préstamo
            $rspta = $prestamo->insertar($idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo);
            echo $rspta ? "Préstamo registrado" : "No se pudo registrar el préstamo";
        } else {
            // Editar préstamo existente
            $rspta = $prestamo->editar($idprestamo, $idcliente, $usuario, $fprestamo, $monto, $interes, $saldo, $formapago, $fechapago, $plazo, $fplazo);
            echo $rspta ? "Préstamo actualizado" : "No se pudo actualizar el préstamo";
        }
        break;

    case 'eliminar':
        // Eliminar préstamo
        $rspta = $prestamo->eliminar($idprestamo);
        echo $rspta ? "Préstamo eliminado" : "No se pudo eliminar el préstamo";
        break;

    case 'cancelado':
        // Cancelar préstamo
        $rspta = $prestamo->cancelado($idprestamo);
        echo $rspta ? "Préstamo cancelado" : "No se pudo cancelar el préstamo";
        break;

    case 'mostrar':
        // Mostrar datos de un préstamo
        $rspta = $prestamo->mostrar($idprestamo);
        echo json_encode($rspta);
        break;

    case 'listar':
        // Listar todos los préstamos
        $rspta = $prestamo->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->idprestamo . ')"> <i class="fa fa-pencil"> </i></button>' .
                       ' <button class="btn btn-danger" onclick="eliminar(' . $reg->idprestamo . ')"> <i class="fa fa-trash"> </i></button>',
                "1" => $reg->cliente,
                "2" => $reg->usuario,
                "3" => $reg->fecha,
                "4" => $reg->monto,
                "5" => $reg->interes,
                "6" => $reg->saldo,
                "7" => $reg->formapago,
                "8" => $reg->fechapago,
                "9" => $reg->plazo,
                "10" => $reg->fplazo,
                "11" => ($reg->estado) ? '<span class="label bg-success">Activado</span>' : '<span class="label bg-danger">Cancelado</span>'
            );
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case 'selectCliente':
        require_once "../modelos/Clientes.php";
        $cliente = new Clientes();
        $rspta = $cliente->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="' . $reg->idcliente . '">' . $reg->nombre . '</option>';
        }
        break;

    case 'selectUsuario':
        require_once "../modelos/Usuarios.php";
        $usuario = new Usuarios();
        $rspta = $usuario->select();
        while ($reg = $rspta->fetch_object()) {
            echo '<option value="' . $reg->idusuario . '">' . $reg->nombre . '</option>';
        }
        break;
}
?>
