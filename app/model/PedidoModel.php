<?php

require_once "Connection.php";
require_once "ProductoModel.php";
class PedidoModel extends Connection {
    
    public function getAll() {
        $query = "SELECT * FROM pedido WHERE fecha_eliminado IS NULL ORDER BY fecha_creado DESC";
        $stm = Connection::connect()->prepare($query);
        $stm -> execute();
        $pedidos = $stm -> fetchAll(PDO::FETCH_ASSOC);
        
        return $pedidos;
    }

    public function getById($id) {
        $query = "SELECT * FROM pedido WHERE fecha_eliminado IS NULL AND id= :id  ORDER BY fecha_creado DESC";
        $stm = Connection::connect()->prepare($query);
        $stm -> bindParam("id",$id, PDO::PARAM_INT);
        $stm -> execute();
        return $stm -> fetch(PDO::FETCH_ASSOC);
    }

    public function getByAtendidosAndFechaBetween($fechaInicio, $fechaFin) {
        $query = "SELECT *  FROM pedido WHERE fecha_eliminado IS NULL AND 
                CAST(fecha_creado as DATE) >= :fechaInicio and CAST(fecha_creado as DATE) <= :fechaFin and
                atendido = 1 ORDER BY fecha_creado desc;";
        $stm = Connection::connect() -> prepare($query);
        $stm -> bindParam("fechaInicio", $fechaInicio, PDO::PARAM_STR);
        $stm -> bindParam("fechaFin", $fechaFin, PDO::PARAM_STR);
        $stm -> execute();
        return $stm -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductosByIdPedido($idPedido) {
        $query = "select pp.cantidad, p.nombre, p.precio, p.imagen, pp.ingredientes  from producto_pedido "
        ."pp inner join producto p on p.id = pp.id_producto "
        ."where pp.id_pedido = :id_pedido";
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
        $productoModel = new ProductoModel();
        foreach($pedido['productos'] as  &$producto) {
           
            $stm3 =  Connection::connect() -> prepare("INSERT INTO producto_pedido(id_pedido, id_producto, cantidad, ingredientes)
            VALUES (:id_pedido, :id_producto, :cantidad, :ingredientes)");

            $stm3 -> bindParam("id_pedido",$idPedido['id'], PDO::PARAM_STR);
            $stm3 -> bindParam("id_producto",$producto['id_producto'], PDO::PARAM_STR);
            $stm3 -> bindParam("cantidad",$producto['cantidad'], PDO::PARAM_STR);
            $stm3 -> bindParam("ingredientes", $producto['ingredientes']);
            $res =  $stm3 -> execute();
            
            $productoBase = $productoModel -> getAllById($producto['id_producto']);
            $productoBase['cantidad'] = $productoBase['cantidad'] - $producto['cantidad'];
            $productoModel -> update($productoBase);
        }
        if($res){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }

    }

    public function update($pedido) {
        $stm = Connection::connect() -> prepare("UPDATE pedido SET visto = :visto, atendido = :atendido WHERE id = :id");
        $stm -> bindParam("visto",$pedido['visto'], PDO::PARAM_STR);
        $stm -> bindParam("atendido",$pedido['atendido'], PDO::PARAM_STR);
        $stm -> bindParam("id",$pedido['id'], PDO::PARAM_INT);
        
        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function updateVisto($pedido) {
        $stm = Connection::connect() -> prepare("UPDATE pedido SET visto = :visto WHERE id = :id");
        $stm -> bindParam("visto",$pedido['visto'], PDO::PARAM_STR);
        $stm -> bindParam("id",$pedido['id'], PDO::PARAM_INT);
        
        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }

    public function delete($id) {
        $stm = Connection::connect() -> prepare("UPDATE pedido SET fecha_eliminado = CURDATE() WHERE id = :id");
        $stm -> bindParam("id",$id, PDO::PARAM_STR);
        if($stm->execute()){
            return "success";
        }else{
            $error = $stm->errorInfo();
            return "error ".$error[2];
        }
    }
}