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
        $stm = Connection::connect() -> prepare("INSERT INTO pedido(nombre_completo, direccion, telefono, visto, atendido, fecha_eliminado)
        VALUES (:nombre_completo, :direccion, :telefono, :visto, :atendido, NULL)");
        $atendido =0;
        $visto = 0;
        $stm -> bindParam("nombre_completo",$pedido['nombre_completo'], PDO::PARAM_STR);
        $stm -> bindParam("direccion",$pedido['direccion'], PDO::PARAM_STR);
        $stm -> bindParam("telefono",$pedido['telefono'], PDO::PARAM_STR);
        $stm -> bindParam("visto",$visto, PDO::PARAM_INT);
        $stm -> bindParam("atendido",$atendido, PDO::PARAM_INT);
        $stm -> execute();

        $stm2 = Connection::connect() -> prepare("SELECT MAX(id) as id FROM pedido;");
        $stm2 -> execute();
        $idPedido = $stm2->fetch(PDO::FETCH_ASSOC);
        $res = null;
        foreach($pedido['productos'] as  &$producto) {
            print_r("pedido ".$idPedido['id']);
            $stm3 =  Connection::connect() -> prepare("INSERT INTO producto_pedido(id_pedido, id_producto, cantidad)
            VALUES (:id_pedido, :id_producto, :cantidad)");
            $stm3 -> bindParam("id_pedido",$idPedido['id'], PDO::PARAM_STR);
            $stm3 -> bindParam("id_producto",$producto['id_producto'], PDO::PARAM_STR);
            $stm3 -> bindParam("cantidad",$producto['cantidad'], PDO::PARAM_STR);
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

        $result = null;

        return $result;
    }
}