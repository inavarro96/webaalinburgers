<?php

// Terminar la notificacion
// --- restar cantidad cuando se genere un  nuevo pedido
// --- Cerrar la sesión
// --- Privilegios
// Limpiar ventas
// --- corregir las imagenes en las ventas
// ---Cerrar la ventana cuando se gregue un producto en el carrito
// ---Vaciar carrito una vez que se finalice la compra
// --Quitar twtter y facebook no se abrá en otra página https://www.facebook.com/profile.php?id=100063828090806
// --Mision y vision
require_once "Connection.php";

class NotificacionModel extends Connection {

    public function insert($notificacion) {
        $stm = Connection::connect() -> prepare("INSERT INTO notificacion(asunto, descripcion) VALUES(:asunto, :descripcion)");

        $stm -> bindParam("asunto", $notificacion['asunto']);
        $stm -> bindParam("descripcion", $notificacion['descripcion']);

        if($stm -> execute()) {
            $stm2 = Connection::connect() -> prepare("SELECT MAX(id) as id FROM notificacion;");
            $stm2 -> execute();
            $idNotificacion = $stm2->fetch(PDO::FETCH_ASSOC);
            return  $idNotificacion['id'];
        } else {
            $error = $stm->errorInfo();
            return "error".$error[2];
        }
    }

    public function insertNotificacionUsuarios($idNotificacion, $usuarios) {
        foreach($usuarios as &$usuario) {
            $stm = Connection::connect() -> prepare("INSERT INTO notificacion_usuario(id_notificacion, id_usuario) VALUES (:idNotificacion, :idUsuario)");
            $stm -> bindParam("idNotificacion",$idNotificacion, PDO::PARAM_STR);
            $stm -> bindParam("idUsuario",$usuario['id'], PDO::PARAM_STR);

            $stm -> execute();
        }

        return 'success';
    }

    public function getAll($idUsuario) {

        $query = "SELECT * FROM notificacion_usuario nu "
                ."INNER JOIN notificacion n ON nu.id_notificacion = n.id "
                ."WHERE nu.id_usuario = :idUsuario";

        $stm = Connection::connect() -> prepare($query);
        $stm -> bindParam("idUsuario", $idUsuario);

        $stm -> execute();

        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($idUsuario, $idNotificacion) {
        
        $stm = Connection::connect() -> prepare("DELETE FROM notificacion_usuario WHERE id_notificacacion = :idNotificacion AND id_usuario = :idUsuario");

        $stm -> bindParam("idUsuario",$idUsuario);
        $stm -> bindParam("idNotificacion", $idNotificacion);

        if($stm->execute()) {
            return "sucess";
        } else {
            $error = $stm -> errorInfo();
            return "error ". $error[2];
        }
    }

}

