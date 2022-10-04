<?php

require_once "../model/ProductoModel.php";
require_once "../service/ArchivoService.php";

header('Content-Type: application/json');
$response = array('state'=>'', 'data'=>'');

if(isset($_GET['action']) AND !empty($_GET['action'])) {

    $service = new ArchivoService();
    if($_GET['action']=='post-foto') {
        $response['state'] = 'OK';
        $response['data']=$service->postFoto($_FILES);
    }
} else {
    $response['state'] = 'Error acción no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);