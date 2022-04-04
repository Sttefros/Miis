<?php

class Conectar{

    public static function conexion(){
        $servidor = 'localhost';
        $usuario = 'root';
        $password = '';
        $basededatos = 'cmsj_inventario';

        $conexion = new mysqli("$servidor", "$usuario", "$password", "$basededatos");
            return $conexion;
    }
}


?>