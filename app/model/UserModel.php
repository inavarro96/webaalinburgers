<?php

require_once "Connection.php";

class UsuarioModel extends Connection {
    
    public function insert($user) {
        $stm = Connection::connect() -> prepare("INSERT INTO usuario(usuario, telefono, password, nombre, apellidos, perfil) VALUES (:usuario, :telefono,:password, :nombre, :apellidos, :perfil)");

        $options = [
            'cost' =>12
        ];

        $passwordEncrypt = password_hash($user['password'], PASSWORD_BCRYPT,  $options);
        $stm -> bindParam("usuario",$user['usuario'], PDO::PARAM_STR);
        $stm -> bindParam("telefono",$user['telefono'], PDO::PARAM_STR);
        $stm -> bindParam("password",$passwordEncrypt, PDO::PARAM_STR);
        $stm -> bindParam("nombre",$user['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("apellidos",$user['apellidos'], PDO::PARAM_STR);
        $stm -> bindParam("perfil",$user['perfil'], PDO::PARAM_INT);

        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function update($user) {
        $stm = Connection::connect() -> prepare("UPDATE usuario SET usuario = :usuario, nombre = :nombre, apellidos = :apellidos, telefono = :telefono, perfil = :perfil WHERE id = :id");

        $stm -> bindParam("usuario",$user['usuario'], PDO::PARAM_STR);
        $stm -> bindParam("telefono",$user['telefono'], PDO::PARAM_STR);
        $stm -> bindParam("nombre",$user['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("apellidos",$user['apellidos'], PDO::PARAM_STR);
        $stm -> bindParam("perfil",$user['perfil'], PDO::PARAM_STR);
        $stm -> bindParam("id",$user['id'], PDO::PARAM_STR);

        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function updatePassword($user) {
        $stm = Connection::connect() -> prepare("UPDATE usuario SET usuario = :usuario, password = :password WHERE id = :id");

        $options = ['cost' => 12];
        $passworEncrypt = password_hash($user['password'], PASSWORD_BCRYPT, $options);
        $stm -> bindParam("password",$user['password'], PDO::PARAM_STR);
        $stm -> bindParam("usuario",$user['usuario'], PDO::PARAM_STR);
        $stm -> bindParam("id",$user['id'], PDO::PARAM_STR);
        
        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function delete($id) {
        $stm = Connection::connect() -> prepare("UPDATE usuario SET fecha_baja = CURDATE() WHERE id = :id");
        $stm -> bindParam("id",$id, PDO::PARAM_STR);
        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function getAll() {
        $query = "SELECT * FROM usuario WHERE fecha_baja IS NULL";
        $stm = Connection::connect()->prepare($query);
        $stm->execute();
        $user = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function login($dataUser) {
        $query = "SELECT * FROM usuario WHERE usuario = :usuario AND fecha_baja IS NULL";

        $stm = Connection::connect() -> prepare($query);
        $stm -> bindParam("usuario",$dataUser['usuario'], PDO::PARAM_STR);

        $stm -> execute();
        
        $user = $stm -> fetch(PDO::FETCH_ASSOC);

        if(!empty($user) && password_verify($dataUser['password'], $user['password']) == 1) {
            return $user;
        } 
        
        return 'Usuario o contrase??a wsdwqdincorrectos';
        
    }
}