<?php

class DepartamentoController{

    public function __construct() {
        require_once 'modelo/Departamento_model.php';
        require_once 'modelo/Centro_model.php';
    }
    public function index(){
        $departamentos = new Departamento_model();
        $data["titulo"] = "Departamentos";
        $data["departamentos"] = $departamentos->getDepartamentos();

        require_once 'vista/departamento/departamento.php';
    }
    public function nuevo(){
        $data["titulo"] = "Nuevo Departamento";
        $centros = new Centro_model();
        $data["centros"] = $centros->getCentros();
        require_once 'vista/departamento/departamento_nuevo.php';
    }
    public function guardar(){
        $id = null;
        $nombre = $_POST["nombre"];
        $centro = $_POST["centro"];
        $departamentos = new Departamento_model();
        $departamentos->insertarDepartamento($id, $nombre,$centro);
    
        $this->index();
    }
    public function modificar($id){
        $departamento = new Departamento_model();
        $centros = new Centro_model();
        $data["id"] = $id;
        $data["departamento"] = $departamento->getDepartamento($id);
        $data["centros"] = $centros->getCentros();
        $data["titulo"] = "Editar Departamento";
        require_once 'vista/departamento/departamento_editar.php';
    }
    public function actualizar(){
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $departamento = new Departamento_model();
        $departamento->modificarDepartamento($id, $nombre);

        $data["titulo"] = "Departamentos";
        $this->index();
    }
    public function eliminar($id){
        $departamento = new Departamento_model();
        $departamento->eliminarDepartamento($id);
        $data["titulo"] = "Departamentos";
        $this->index();
    }
}
?>