<?php

class SplitFecha {

    public function convertirToArray($fecha) {
        $fecha = substr($fecha, 0, 10);
        return explode("-", $fecha);
    }
}