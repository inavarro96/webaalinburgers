<?php

require_once "Connection.php";


class UsuarioModel extends Connection {

    public function insert($user) {
        $stm = Connection::connect() -> prepare("INSERT INTO usuario(usuario, telefono, password, nombre, apellidos, perfil) VALUES (:usuario, :telefono,:password, :nombre, :apellidos, :perfil)");

        $encrypt = new EncriptacionMd5();
        $passwordEncrypt = $encrypt ->encriptar($user['password']);
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
        $stm = Connection::connect() -> prepare("UPDATE usuario SET usuario = :usuario, nombre = :nombre, apellidos = :apellidos, telefono = :telefono, perfil = :perfil, password = :password WHERE id = :id");
        $encrypt = new EncriptacionMd5();
        $passwordEncrypt = $encrypt ->encriptar($user['password']);
        $stm -> bindParam("usuario",$user['usuario'], PDO::PARAM_STR);
        $stm -> bindParam("telefono",$user['telefono'], PDO::PARAM_STR);
        $stm -> bindParam("nombre",$user['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("apellidos",$user['apellidos'], PDO::PARAM_STR);
        $stm -> bindParam("perfil",$user['perfil'], PDO::PARAM_STR);
        $stm -> bindParam("password",$passwordEncrypt, PDO::PARAM_STR);
        $stm -> bindParam("id",$user['id'], PDO::PARAM_STR);

        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function updatedPassword($user) {
        $stm = Connection::connect() -> prepare("UPDATE usuario SET usuario = :usuario, password = :password WHERE id = :id");

        $encrypt = new EncriptacionMd5();
        $passworEncrypt = $encrypt ->encriptar($user['password']);
        $stm -> bindParam("password",$passworEncrypt, PDO::PARAM_STR);
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
        $encrypt = new EncriptacionMd5();
        $query = "SELECT * FROM usuario WHERE fecha_baja IS NULL";
        $stm = Connection::connect()->prepare($query);
        $stm->execute();
        $users = $stm->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($users); $i++) {

            $users[$i]['password'] =  $encrypt -> desencriptar($users[$i]['password']);
        }
        return $users;
    }

    public function login($dataUser) {
        $query = "SELECT * FROM usuario WHERE usuario = :usuario AND fecha_baja IS NULL";
        $encrypt = new EncriptacionMd5();
        $stm = Connection::connect() -> prepare($query);
        $stm -> bindParam("usuario",$dataUser['usuario'], PDO::PARAM_STR);

        $stm -> execute();
        
        $user = $stm -> fetch(PDO::FETCH_ASSOC);

        if($encrypt ->desencriptar($user['password']) === $dataUser['password']) {
            return $user;
        } 
        
        return 'Usuario o contraseña wsdwqdincorrectos';
        
    }
}