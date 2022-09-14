<?php

require_once "Connection.php";

class ProductoModel extends Connection {

    public function insert($producto) {
        $stm = Connection::connect()->prepare("INSERT INTO producto(nombre, precio, descripcion, cantidad,imagen) VALUES(:nombre, :precio, :descripcion, :cantidad,:imagen)");
        $stm -> bindParam("nombre", $producto['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("precio", $producto['precio'], PDO::PARAM_STR);
        $stm -> bindParam("descripcion", $producto['descripcion'], PDO::PARAM_STR);
        $stm -> bindParam("cantidad", $producto['cantidad'], PDO::PARAM_STR);
        $stm -> bindParam("imagen", $producto['imagen'], PDO::PARAM_STR);
        if($stm->execute()) {
            return "success";
        } else {
            $error = $stm->errorInfo();
            prin_r($stm->errorInfo());
            return "Error: ".$error[2];

        }
    }

    public function update($producto) {
        $stm = Connection::connect()->prepare("UPDATE producto SET nombre = :nombre, precio = :precio, descripcion = :descripcion WHERE id = :id");
        $stm -> bindParam("nombre", $producto['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("precio", $producto['precio'], PDO::PARAM_INT);
        $stm -> bindParam("descripcion", $producto['descripcion'], PDO::PARAM_STR);
        $stm -> bindParam("id", $producto['id'], PDO::PARAM_INT);
        if($stm->execute()) {
            return "success";
        } else {
            $error = $stm->errorInfo();
            prin_r($stm->errorInfo());
            return "Error: ".$error[2];

        }
    }

    public function delete($id) {
        $stm = Connection::connect() -> prepare("UPDATE producto SET fecha_baja = CURDATE() WHERE id = :id");
        $stm -> bindParam("id", $producto['id'], PDO::PARAM_INT);
        if($stm->execute()) {
            return "success";
        } else {
            $error = $stm->errorInfo();
            prin_r($stm->errorInfo());
            return "Error: ".$error[2];

        }
    }

    public function getAll() {
        $query = "SELECT * FROM producto WHERE fecha_baja IS NULL";
        $stm = Connection::connect()->prepare($query);

        $stm ->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllById($id) {
        $query = "SELECT * FROM producto WHERE fecha_baja IS NULL AND id = $id";
        $stm = Connection::connect()->prepare($query);
        $stm -> bindParam("id", $producto['id'], PDO::PARAM_INT);
        
        $stm ->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
}