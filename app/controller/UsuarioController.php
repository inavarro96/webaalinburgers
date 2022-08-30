<?php

require_once "../model/UsuarioModel.php";
require_once "../service/UsuarioService.php";

header('Content-Type: application/json');
$response = array('state'=>'', 'data'=>'');


if(isset($_GET['action']) and !empty($_GET['action'])) {

    $service = new UsuarioService();
    $response['state'] = 'OK';

    if($_GET['action'] === 'login') {
       $response['data'] = $service -> login($_POST);
    }

    if($_GET['action'] === 'getAll') {
        $response['data'] = $service -> getAll($_POST);
     }

     if($_GET['action'] === 'post') {
        $response['data'] = $service-> post($_POST);
     }

     if($_GET['action'] === 'put') {
        $response['data'] = $service-> put($_POST);
     }

     if($_GET['action'] === 'delete') {
        $response['data'] = $service -> delete($_POST['id']);
     }

} else {
    $response['state'] = 'Error acion no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);