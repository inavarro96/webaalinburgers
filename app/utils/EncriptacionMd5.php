<?php

class EncriptacionMd5 {

    public function encriptar ($texto) {
        return base64_encode($texto);
    }

    function desencriptar($texto) {
        return base64_decode($texto);
    }

}