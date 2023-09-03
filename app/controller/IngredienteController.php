<?php
require_once "../model/IngredienteModel.php";
require_once "../service/IngredienteService.php";

header('Content-Type: application/json');
$response = array('state'=>'','data' => '');

if(isset($_GET['action']) and !empty($_GET['action'])) {

    $service = new IngredienteService();
    $response['state'] = 'OK';

    if($_GET['action'] === 'getById') {
        $response['data'] = $service -> getById($_GET['id']);
    }

    if($_GET['action'] === 'post') {
        $response['data'] = $service -> post($_POST);
    }

    if($_GET['action'] === 'put') {
        $response['data'] = $service -> put($_POST);
    }

    if($_GET['action'] === 'delete') {
        $response['data'] = $service -> delete($_POST['id']);
    }

} else {
    $response['state'] = 'Accion no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);