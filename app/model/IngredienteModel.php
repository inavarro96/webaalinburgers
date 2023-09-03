<?php

require_once "Connection.php";
class IngredienteModel extends Connection {

    public function insert($ingrediente) {
        $query = "INSERT INTO ingrediente(nombre) VALUES (:nombre)";
        $stm = Connection::connect()->prepare($query);
        $stm -> bindParam("nombre", $ingrediente['nombre'], PDO::PARAM_STR);
        if ($stm -> execute()) {
            return $this-> getLastId();
        } else {
            $error = $stm->errorInfo();
            return "Error: ".$error[2];
        }
    }

    public function update($ingrediente) {
        $query = "UPDATE ingrediente SET nombre = :nombre WHERE id = :id";

        $stm = Connection::connect()->prepare($query);
        $stm -> bindParam("nombre", $ingrediente['nombre'], PDO::PARAM_STR);
        $stm -> bindParam("id", $producto["id"]);
        if ($stm -> execute()) {
            return "success";
        } else {
            $error = $stm->errorInfo();
            return "Error: ".$error[2];
        }

    }

    public function delete($id) {
        $stm = Connection::connect() ->prepare("UPDATE ingrediente SET fecha_baja = CURDATE() WHERE id: id");
        $stm ->bindParam("id", $id, PDO::PARAM_INT);
        if($stm->execute()) {
            return "success";
        } else {
            $error = $stm->errorInfo();
            return "Error: ".$error[2];

        }
    }

    public function getByProductoId($idProducto) {
        $query = "SELECT * FROM ingrediente WHERE fecha_baja IS NULL AND id_producto = :idProducto";
        $stm = Connection::connect() ->prepare($query);
        $stm -> bindParam("idProducto", $idProducto, PDO::PARAM_INT);
        $stm ->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    private function getLastId() {
        $query = "SELECT MAX(id) as id FROM ingrediente;";
        $stm = Connection::connect()->prepare($query);

        $stm ->execute();
        $id = $stm->fetch(PDO::FETCH_ASSOC);
        return $id['id'];

    }
}