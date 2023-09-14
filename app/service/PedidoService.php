<?php
class PedidoService {

    public function getAll() {

        $result = null;
        $model = new PedidoModel();
        $result = $model -> getAll();
        return $result;
    }

    public function getProductosByIdPedido($idPedido) {
        $result = null;
        $model = new PedidoModel();
        $result = $model -> getProductosByIdPedido($idPedido);
        $pedido = array('id' => $idPedido,'visto'=>1);
        $model -> updateVisto($pedido);
        return $result;
    }

    public function post($pedido) {
        $result = null;
        if(isset($pedido['nombre_completo']) and !empty($pedido['nombre_completo'])) {
            $model = new PedidoModel();
            $result = $model -> insert($pedido);
            if($result == "success") {
                session_start();
                session_destroy();
                $notificacionService = new NotificacionService();
                $notificacionService ->crear("Nuevo pedido","Se ha creado un nuevo pedido de ".$pedido['nombre_completo'].", esta en espera de ser atendido");
            }

        }else {
            $result = 'No ha ingresado por completo los datos';
        }

        return $result;
    }

    public function addProducto($pedido) {
        $result = null;
        if(isset($pedido['id_producto']) and !empty($pedido['id_producto'])) {
            session_start();
           $productos = array();

           if(isset( $_SESSION['productos'] )) {
                $productos = $_SESSION['productos'];
           }
           array_push($productos, $pedido);
           $_SESSION['productos'] = $productos;
           $result='success';
        } else {
            $result='Sin id_producto';
        }
        return $result;
    }

    public function cancelarPedido() {
        session_start();
        session_destroy();
        return 'Pedido cancelado';
    }

    public function getProductos() {
        $result = null;
        $productos = [];
        session_start();
        if(isset( $_SESSION['productos'] )) {
            $productos = $_SESSION['productos'];
        }
        $result = $productos;
        
        return $result;
    }

    public function put($pedido) {
        $result = null;

        if(isset($pedido) and !empty($pedido)) {
            $model = new PedidoModel();
            $result = $model -> update($pedido);
        } else {
            $result = 'No cuenta con ID para eliminar';
        }

        return $result;
    }

    public function deleteVarios($ids) {
        if(isset($ids) and !empty($ids)) {
            $arrayId = explode(",", $ids);
            $model = new PedidoModel();
            foreach($arrayId as &$id) {
                $model -> delete($id);
            }
            return 'Se han eliminado los pedidos';
        }
        
        return 'No cuenta con ids para eliminar';
    
    }
    public function delete($id) {
        $result = null;

        if(isset($id) and !empty($id)) {
            $model = new PedidoModel();
            $result = $model -> delete($id);
        } else {
            $result = 'No cuenta con ID para eliminar';
        }

        return $result;
    }
}