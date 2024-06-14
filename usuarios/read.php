<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/usuarios.php';

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$usuarios->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $usuarios->read();

if ($result->num_rows > 0) {
    $usuariosRecords = array();
    $usuariosRecords["usuarios"] = array();
    while ($usuarios = $result->fetch_assoc()) {
        extract($usuarios);
        $usuariosDetails = array(
            "id" => $id,
            "nombre" => $nombre,
            "numero" => $numero,
            "fecha_inicio" => $fecha_inicio,
            "fecha_final" => $fecha_final,
            "estado" => $estado,
            "estado_usuario" => $estado_usuario,
            "dias_restantes" => $dias_restantes,
            "nombre_negocio" => $nombre_negocio,
            "detalle" => $detalle,
            "precio" => $precio,
            "fecha_creado" => $fecha_creado
        );
        array_push($usuariosRecords["usuarios"], $usuariosDetails);
    }
    http_response_code(200);
    echo json_encode($usuariosRecords);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encuentra el usuario.")
    );
}
