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

if(!empty($data->id)) {
	$usuarios->id = $data->id;
	if($usuarios->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "El usuario fue eliminado."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "No se puede eliminar el usuario."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Incapaz de eliminar el usuario. Los datos están incompletos."));
}
?>