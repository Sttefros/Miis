<?php

Class HistorialController{
    //contructor para cargar todos los modelos de la carpeta model
    public function __construct(){
        require_once 'modelo/Insumo_model.php';
        require_once 'modelo/Centro_model.php';
        require_once 'modelo/Categoria_model.php';
        require_once 'modelo/Departamento_model.php';
        require_once 'modelo/Box_model.php';
        require_once 'modelo/Historial_model.php';
    }
    public function index(){
        $historial = new Historial_model();
        $data["titulo"] = "Historial de insumos";
        $data["historial"] = $historial->get_historial();
        require_once 'vista/historial/historial.php';
    }
    public function index1(){
        session_start();
        $historial = new Historial_model();
        $centro = new Centro_model();
        $data["titulo"] = "Historial de movimientos";
        $centr = $centro->getIdCentro($_SESSION["encargado"]["id_usuario"]);
        $data["historial"] = $historial->get_historial_encargado($centr["id_centro"]);
        require_once 'vista/historial/historial.php';
    }


}


?>