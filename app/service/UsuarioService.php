<?php

class UsuarioService {

    public function post($usuario) {
        $result = null;

        if(isset($user['usuario']) and !empty($usuario['usuario'])){
            $mvc = new UsuarioModel();
            $result = $mvc -> insert($usuario);
        } else {
            $result = 'Si datos';
        }

        return $result;
    }

    public function update($usuario) {
        $result = null;

        if(isset($usuario['id']) and !empty($usuario['id'])) {
            $mvc = new usuarioModel();
            $result = $mvc -> update($usuario);
        } else {
            $result = 'Sin datos';
        }
        return $result;
    }

    public function delete($id) {
        $result = null;

        if(isset($id) and !empty($id)) {
            $result = $mvc -> delete($id);
        } else {
            $result = 'Sin datos';
        }

        return $result;
    }

    public function getAll() {
        $result = null;

        $mvc = new UsuarioModel();
        $resul = $mvc -> getAll();

        return $result;
    }

    public function login($usuario) {
        $result = null;
        
        if(isset($usuario['usuario']) and !empty($usuario['usuario'])) {
            
            $mvc = new UsuarioService();
            $user = $mvc -> login($usuario);

            if(isset($user) and !empty($user)) {
                session_start();
                $_SESSION['user'] = $user
                $result = $user;
            } else {
                $result = 'Usuario o contraseña incorrectos';
            }
        } else {
            $result = 'No ingresó datos';
        }

        return $result;
    }
}