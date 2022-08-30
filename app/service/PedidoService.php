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
        return $result;
    }

    public function post($pedido) {
        $result = null;
        if(isset($pedido['nombre_completo']) and !empty($pedido['nombre_completo'])) {
            $model = new PedidoModel();
            $result = $model -> insert($pedido);
        }else {
            $result = 'No ha ingresado por completo los datos';
        }

        return $result;
    }

    public function delete($pedido) {
        $result = null;

        if(isset($id) and !empty($id)) {
            $model = new PedidoModel();
            $result = $model -> delete();
        } else {
            $result = 'No cuenta con ID para eliminar';
        }

        return $result;
    }
}