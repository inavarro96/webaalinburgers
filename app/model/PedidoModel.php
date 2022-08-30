<?php

require_once "Connection.php";

class PedidoModel extends Connection {
    
    public function getAll() {
        $query = "SELECT * FROM pedido WHERE fecha_eliminado IS NOT NULL";
        $stm = Connection::connect()->prepare($query);
        $stm -> execute();
        $pedidos = $stm -> fetchAll(PDO::FETCH_ASSOC);
        
        return $pedidos;
    }

    public function getProductosByIdPedido($idPedido) {
        $query = "SELECT * FROM producto_pedido WHERE id_producto = :id_pedido";
        $stm = Connection::connect()->prepare($query);
        $stm -> bindParam("id_pedido",$idPedido, PDO::PARAM_INT);
        $stm -> execute();
        $productos = $stm -> fetchAll(PDO::FETCH_ASSOC);
        
        return $productos;
    }

    public function insert($pedido) {
        $stm = Connection::connect() -> prepare("INSERT INTO pedido(nombre_completo, direccion, telefono, visto, atendido, fecha_creado, fecha_eliminado)
        VALUES (:nombre_completo, :direccion, :telefono, :visto, :atendido, :fecha_creado, NULL)");

        $stm -> bindParam("nombre_completo",$pedido['nombre_completo'], PDO::PARAM_STR);
        $stm -> bindParam("direccion",$pedido['direccion'], PDO::PARAM_STR);
        $stm -> bindParam("telefono",$pedido['telefono'], PDO::PARAM_STR);
        $stm -> bindParam("visto",$pedido['visto'], PDO::PARAM_STR);
        $stm -> bindParam("fecha_creado",$pedido['fecha_creado'], PDO::PARAM_STR);
        $stm -> bindParam("usuario",$pedido['usuario'], PDO::PARAM_STR);

        $stm -> execute();

        $stm2 = Connection::connect() -> prepare("SELECT last_insert_id() AS id");
        $stm2 -> execute();
        $idPedido = $stm2->fetch(PDO::FETCH_ASSOC);
        $res = null;
        foreach($pedido['productos'] as  &$producto) {
            
            $stm3 =  Connection::connect() -> prepare("INSERT INTO producto_pedido(id_pedido, id_producto)
            VALUES (:id_pedido, :id_producto)");
            $stm3 -> bindParam("id_pedido",$producto['id'], PDO::PARAM_STR);
            $stm3 -> bindParam("id_producto",$idPedido['id_pedido'], PDO::PARAM_STR);
           
            $res =  $stm3 -> execute();
        }
        if($res){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }

    }

    public function delete($pedido) {

    }
}