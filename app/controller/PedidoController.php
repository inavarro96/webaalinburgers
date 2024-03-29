<?php

require_once "../model/PedidoModel.php";
require_once "../model/ProductoModel.php";
require_once "../model/UserModel.php";
require_once "../model/NotificacionModel.php";
require_once "../service/NotificacionService.php";
require_once "../utils/Message.php";
require_once "../utils/SplitFecha.php";

require_once "../service/PedidoService.php";

header('Content-Type: application/json');
$response = array('state' => '', 'data' => '');

if(isset($_GET['action']) and !empty($_GET['action'])) {
    $service = new PedidoService();
    $response['state'] = 'OK';

    if($_GET['action'] == 'post') {
        $response['data'] = $service -> post($_POST);
    }
    if($_GET['action'] == 'addProducto') {
        $response['data'] = $service -> addProducto($_POST);
    }

    if($_GET['action'] == 'cancelarPedido') {
        $response['data'] = $service -> cancelarPedido();
    }

    if($_GET['action'] == 'getProductos') {
        $response['data'] = $service -> getProductos();
    }

    if ($_GET['action'] === 'getByAtendidosAndFechaBetween') {
        $response['data'] = $service ->getByAtendidosAndFechaBetween($_GET['fechaInicio'], $_GET['fechaFin']);
    }

    if($_GET['action'] === 'getEstadisticasProductoAndFechaBetween') {
        $response['data'] = $service -> getEstadisticasProducto($_GET['fechaInicio'], $_GET['fechaFin']);
    }

    if($_GET['action'] == 'put') {
        $response['data'] = $service -> put($_POST);
    }
    if($_GET['action'] == 'delete') {
        $response['data'] = $service -> delete($_POST['id_pedido']);
    }

    if($_GET['action'] == 'deleteSelected') {
        $response['data'] = $service -> deleteVarios($_POST['ids']);
    }

    if($_GET['action'] == 'getAll') {
        $response['data'] = $service -> getAll();
    }

    if($_GET['action'] == 'getProductosByIdPedido') {
        $response['data'] = $service -> getProductosByIdPedido($_GET['id_pedido']);
    }
} else {
    $response['state'] = 'Acción no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);