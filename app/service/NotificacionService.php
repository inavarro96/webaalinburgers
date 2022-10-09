<?php

class NotificacionService {

    public function crear($asunto, $descripcion) {
        $mvc = new NotificacionModel();

        if(!isset($asunto) and empty($descripcion)) {
            return 'Sin asunto y descripcion la notificacion';
        }

        $notificacion = array('asunto'=>$asunto,'descripcion' => $descripcion);

        $idN = $mvc -> insert($notificacion);
        $mvcUser = new UsuarioModel();
        $usuarios = $mvcUser -> getAll();

        $mvc ->insertNotificacionUsuarios($idN['id'], $usuarios);

        return true;
    }

    public function getAll($idUsuario) {
        $mvc = new NotificacionModel();
        return $mvc -> getAll($idUsuario);
    }

    public function delete($idNotificacion, $idUsuario) {
        $result = null;
        if(isset($idNotificacion) and !empty($idUsuario)) {
            $mvc = new NotificacionModel();
            return $mvc -> delete($idNotificacion, $idUsuario);
        }

        return 'Sin idUsuario ni idNotificacion';
    }
}