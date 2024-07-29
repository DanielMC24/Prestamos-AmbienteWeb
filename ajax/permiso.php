<?php 
require_once "../modelos/Permisos.php";

$permiso = new Permisos();

switch ($_GET["op"]) {
    case 'listar':
        // Llamar al método listar del modelo
        $rspta = $permiso->listar();

        // Declarar un array para almacenar los resultados
        $data = array();

        // Iterar sobre el array de resultados
        foreach ($rspta as $reg) {
            $data[] = array(
                "0" => $reg['idpermiso'],
                "1" => $reg['permiso']
            );
        }

        // Preparar la respuesta para el DataTables
        $results = array(
            "sEcho" => 1, // Información para el DataTables
            "iTotalRecords" => count($data), // Total de registros enviados al DataTables
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );

        // Enviar la respuesta como JSON
        echo json_encode($results);
        break;
}
?>
