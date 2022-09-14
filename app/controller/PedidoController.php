<?php

require_once "../model/PedidoModel.php";
require_once "../service/PedidoService.php";

header('Content-Type: application/json');
$response = array('state' => '', 'data' => '');

if(isset($_GET['action']) and !empty($_GET['action'])) {
    $service = new PedidoService();
    $response['state'] = 'OK';

    if($_GET['action'] == 'post') {
        $response['data'] = $service -> post($_POST);
    }

    if($_GET['action'] == 'delete') {
        $response['data'] = $service -> post($_POST['id_pedido']);
    }

    if($_GET['action'] == 'getAll') {
        $response['data'] = $service -> getAll();
    }

    if($_GET['action'] == 'getProductosByIdPedido') {
        $response['data'] = $service -> getProductosByIdPedido($_POST['id_pedido']);
    }
} else {
    $response['state'] = 'Acción no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);