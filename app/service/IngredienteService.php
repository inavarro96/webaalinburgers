<?php

class IngredienteService {
    public function post($ingrediente) {
        $result = null;

        if(isset($ingrediente['nombre']) and !empty($ingrediente['nombre'])){

            $mvc = new IngredienteModel();
            $result = $mvc -> insert($ingrediente);
        } else {
            $result = 'Sin datos';
        }

        return $result;
    }

    public function update($ingrediente) {
        $result = null;

        if(isset($ingrediente['id']) and !empty($ingrediente['id'])) {
            $mvc = new IngredienteModel();
            $result = $mvc -> update($ingrediente);
        } else {
            $result = 'Sin datos';
        }
        return $result;
    }

    public function delete($id) {
        $result = null;
        $mvc = new IngredienteModel();
        if(isset($id) and !empty($id)) {
            $result = $mvc -> delete($id);
        } else {
            $result = 'Sin datos';
        }

        return $result;
    }

    public function getByProductoId($idProducto) {
        $mvc = new IngredienteModel();
        return $mvc -> getByProductoId($idProducto);
    }
}