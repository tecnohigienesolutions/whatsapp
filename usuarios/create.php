<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../class/usuarios.php';

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->conteo_mensajes) &&
    !empty($data->mensaje_principal) &&
    !empty($data->mensaje_lineal) &&
    !empty($data->vip) &&
    !empty($data->name_fecha_restante) &&
    !empty($data->whatsapp_accounts_phone_number) &&
    !empty($data->whatsapp_accounts_updated_at) &&
    !empty($data->subscription_plan_name) &&
    !empty($data->subscription_expired_at) &&
    !empty($data->subscription_updated_at) &&
    !empty($data->account_limit)
) {
    
    $usuarios->conteo_mensajes = $data->conteo_mensajes;
    $usuarios->mensaje_principal = $data->mensaje_principal;
    $usuarios->mensaje_lineal = $data->mensaje_lineal;
    $usuarios->vip = $data->vip;
    $usuarios->name_fecha_restante = $data->name_fecha_restante;
    $usuarios->whatsapp_accounts_phone_number = $data->whatsapp_accounts_phone_number;
    $usuarios->whatsapp_accounts_updated_at = $data->whatsapp_accounts_updated_at;
    $usuarios->subscription_plan_name = $data->subscription_plan_name;
    $usuarios->subscription_expired_at = $data->subscription_expired_at;
    $usuarios->subscription_updated_at = $data->subscription_updated_at;
    $usuarios->account_limit = $data->account_limit;

    // $usuarios->fecha_creado = date('Y-m-d H:i:s'); 

    if ($usuarios->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Se creó el usuario."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "No se puede crear el usuario."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "No se puede crear el usuario. Los datos están incompletos."));
}
