<?php

class CentroController {

    public function __construct() {
        require_once 'modelo/Centro_model.php';
        require_once 'modelo/Usuario_model.php';
    }
    public function index() {
        $centros = new Centro_model();
        $data["titulo"] = "Centros San Joaquin";
        $data["centros"] = $centros->getCentros();

        require_once 'vista/centro/centro.php';
    }
    
    public function nuevo(){
        $usuario = new Usuario_model();
        $data["titulo"] = "Nuevo Centro";
        $data["usuario"] = $usuario->getUsuariosEncargado();
        require_once 'vista/centro/centro_nuevo.php';
    }
    public function guardar(){
        $id = null;
        $nombre = strtoupper($_POST["nombre"]);
        $direccion = strtoupper($_POST["direccion"]);
        $encargado = $_POST["usuario"];

        $centros = new Centro_model();
        $centros->insertarCentro($id, $nombre, $direccion, $encargado);

        $data["titulo"] = "Centros San Joaquin";
        $this->index();
    }
    public function modificar($id){
        $centros = new Centro_model();
        $usuarios = new Usuario_model();
        $data["id"] = $id;
        $data["centro"] = $centros->getCentro($id);
        $data["usuario"] = $usuarios->getUsuariosEncargado();
        $data["titulo"] = "Editar Centro";
        require_once 'vista/centro/centro_editar.php';
    }
    public function actualizar(){
        $id = $_POST["id"];
        $nombre = strtoupper($_POST["nombre"]);
        $direccion = strtoupper($_POST["direccion"]);
        $encargado = $_POST["encargado"];
        
        $centros = new Centro_model();
        $centros->modificarCentro($id, $nombre, $direccion, $encargado);

        $data["titulo"] = "Centros San Joaquin";
        $this->index();
    }
    public function eliminar($id){
        $centros = new Centro_model();
        $centros->eliminarCentro($id);
        $data["titulo"] = "Centros San Joaquin";
        $this->index();
    }
}
?>