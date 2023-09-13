<?php

require_once "../model/UserModel.php";
require_once "../service/UsuarioService.php";
require_once "../utils/EncriptacionMd5.php";

header('Content-Type: application/json');
$response = array('state'=>'', 'data'=>'');


if(isset($_GET['action']) and !empty($_GET['action'])) {

    $service = new UsuarioService();
    $response['state'] = 'OK';

    if($_GET['action'] === 'login') {
       $response['data'] = $service -> login($_POST);
    }

    if($_GET['action'] === 'getAll') {

        $response['data'] = $service -> getAll();
     }
    if($_GET['action'] === 'getAll') {

        $response['data'] = $service -> getAll();
    }

     if($_GET['action'] === 'post') {
     
         $response['data'] = $service-> post($_POST);
     }

    if($_GET['action'] === 'registrarUsuario') {
        $_POST['usuario'] = "israel2";
        $_POST['telefono'] = "7361040461";
        $_POST['password'] = "israel2";
        $_POST['nombre'] = "Israel";
        $_POST['apellidos'] = "Navarro";
        $_POST['perfil'] = "1";

        $response['data'] = $service-> post($_POST);


    }

     if($_GET['action'] === 'put') {
        $response['data'] = $service-> update($_POST);
     }

     if($_GET['action'] === 'delete') {
        $response['data'] = $service -> delete($_POST['id']);
     }

} else {
    $response['state'] = 'Error acion no encontrada';
}

echo json_encode($response, JSON_FORCE_OBJECT);