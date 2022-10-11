<?php

require_once "../model/NotificacionModel.php";
require_once "../service/NotificacionService.php";
require_once "../model/UserModel.php";
require_once "../utils/Message.php";

header('Content-Type: application/json');
$response = array('state'=>'','data' => '');

if(isset($_GET['action']) and !empty($_GET['action'])) {

    $service = new NotificacionService();
    $response['state'] = 'OK';

    if($_GET['action'] === 'getAll') {
        session_start();
        $user = $_SESSION['user'];
        $response['data'] = $service -> getAll($user['id']);
    }
    if($_GET['action'] === 'delete') {
        $response['data'] = $service -> delete($_POST['idNotificacion'],$_POST['idUsuario']);

    }

} else {
    $response['state'] = 'Accion no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);

