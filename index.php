<?php
require_once 'configuracion/config.php';
require_once 'core/router.php';
require_once 'configuracion/conexion.php';

if(isset($_GET['c'])){
    $controlador = cargarControlador($_GET['c']);

    if(isset($_GET['a'])){
        if(isset($_GET['id'])){
            cargarAccion($controlador, $_GET['a'], $_GET['id']);
        }else{
            cargarAccion($controlador, $_GET['a']);
        }
        
    }else{
        cargarAccion($controlador, ACCION_PRINCIPAL);
    }
    
}else{
    $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
    $acciontmp = ACCION_PRINCIPAL;
    $controlador ->$acciontmp();
}
?>