<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../config/Database.php';
include_once '../class/usuarios.php';

$database = new Database();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$usuarios->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $usuarios->estado();

if ($result->num_rows > 0) {
    $usuariosRecords = array();
    $usuariosRecords["usuarios"] = array();


    while ($usuarios = $result->fetch_assoc()) {
        extract($usuarios);
        $fecha = $subscription_expired_at;
        $fechahoy =  date("Y-m-d");
        $resta = strtotime($fecha) - strtotime($fechahoy);
        $dias = $resta / (24 * 3600) + 1; 
        $diapalabra='';
        if ($dias==1) {
            $diapalabra='día';
        } else {
            $diapalabra='días';
        }
        //,banned,free,personal,business
        $nuevoplan='';
            if ($dias<=0) {
               $nuevoplan='ended';
            } else {
                $nuevoplan=$subscription_plan_name; 
            }
            
        
        $usuariosDetails = array(
            "id" => 0,
            "conteo_mensajes" => $conteo_mensajes,
            "mensaje_principal" => $mensaje_principal,
            "mensaje_lineal" => $mensaje_lineal,
            "vip" => $vip,
            "name" => "📅 ".$dias." ".$diapalabra." plan ".$subscription_plan_name,
            "whatsapp_accounts" => array(
                array(
                    "id" => "",
                    "phone_number" => $whatsapp_accounts_phone_number,
                    "account_name" => "",
                    "updated_at" => $whatsapp_accounts_updated_at
                ),
                array(
                    "gingerbread" => "2.3"
                )
            ),
            "subscription" => array(
                "plan" => array(
                        "name" =>$nuevoplan
                ),
                "expired_at" => $subscription_expired_at,
                "updated_at" => $subscription_updated_at
            ),
            "account_limit" => $account_limit
        );
        array_push($usuariosRecords["usuarios"], $usuariosDetails);
    }
    http_response_code(200);



    echo json_encode($usuariosRecords["usuarios"][0]);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encuentra el usuario.")
    );
}
