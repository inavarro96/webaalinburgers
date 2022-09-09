<?php

class ProductoService {
    
    public function post($producto) {
        $result = null;

        if(isset($producto['nombre']) and !empty($producto['nombre'])) {
            $mvc = new ProductoModel();
            $result = $mvc -> insert($producto);
        } else {
            $result = 'No cuenta con datos';
        }

        return $result;
    }

    public function put($producto) {
        $result = null;
        if(isset($producto['id']) and !empty($producto['id'])) {
            
        } else {
            $result = 'No cuenta con datos';
        }

        return $result;
    }

    public function delete($id) {
        $result = null;
        if(isset($id) and !empty($id)) {
            $mvc = new ProductoModel();
            $result = $mvc -> delete();
        } else {
            $result = 'No cuenta con datos';
        }

        return $result;
    }

    public function getAll() {
        $result = null;
        $mvc = new ProductoModel();
        $result = $mvc -> getAll();

        return $result;
    }

    public function getById($id) {
        $resut = null;

        if(isset($id) and !empty($id)) {
            $mvc = new ProductoModel();
            $result = $mvc -> getAllById($id);
        } else {
            $result = 'No cuenta con datos';
        }

        return $result;
    }
}