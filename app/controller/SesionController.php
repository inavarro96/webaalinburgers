<?php

header('Content-Type: application/json');
$response = array('state' => '', 'data' => '');

if(isset($_GET['action']) and !empty($_GET['action'])) {
    $action = $_GET['action'];
    
    if($action === 'get') {
        session_start();
        $response['data'] = $_SESSION['user'];
    }

    if($action === 'destroy') {
        session_start();
        session_destroy();
        $response['data'] = 'Sesión cerrada';
    }
} else {
    $response['state'] = 'Acción no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);