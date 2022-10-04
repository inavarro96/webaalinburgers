<?php

class ArchivoService {
    
    public function postFoto($archivo) {

        $result = null;

        if(isset($archivo['imagen']) and !empty($archivo['imagen'])) {
            $imagen = $archivo['imagen'];
            if($imagen) {
                $nameFile = $this -> genUuid();

                $info =  new SplFileInfo($imagen['name']);

                $ruta_destino_archivo = "../../fotos/".$imagen.".".$info->getExtension();
                $imagen_ok = move_uploaded_file($imagen['tmp_name'], $ruta_destino_archivo);
                if(!$imagen_ok) {
                    return 'No se logró subir el archivo';
                }
                
                $producto = array('nombre'=>'', 'precio'=>'', 'descripcion'=>'','cantidad'=>'','imagen'=> $nameFile.".".$info->getExtension());

                $productoService = new ProductoModel();
                
                return $productoService -> insert($producto);
                
            }
        } else {
            $result = 'No se encontró ningun archivo';
        }

        return $result;
    }


    public function genUuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}