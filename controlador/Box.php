<?php
class BoxController{
    // importar modelos de boxes
    public function __construct(){
        require_once 'modelo/Box_model.php';
        require_once 'modelo/Centro_model.php';
        require_once 'modelo/Departamento_model.php';
    }
    public function index(){
        $boxes = new Box_model();
        $data["titulo"] = "BOX";
        $data["boxes"] = $boxes->getBoxes();
        require_once 'vista/box/box.php';
    }
    public function nuevo(){
        $centros = new Centro_model();
        $data["titulo"] = "Nuevo Box";
        $data["centros"]  = $centros->getCentros();
        require_once 'vista/box/box_nuevo.php';
    }
    public function guardar(){
        $id = null;
        $nombre = strtoupper($_POST["nombre"]);
        $departamento = $_POST["lista22"];
        $box = new Box_model();
        $box->insertarBox($id, $nombre, $departamento);

        $data["titulo"] = "BOX";
        $this->index();
    }
    public function modificar($id){
        $box = new Box_model();
        $departamentos = new Departamento_model();
        $data["id"] = $id;
        $data["box"] = $box->obtener_box($id);
        $idcentro = $data["box"]["centro"];
        $data["departamento"] = $departamentos->getDepartamentosPorId($idcentro);
        $data["titulo"] = "Actualizar informacion del box";
        require_once 'vista/box/box_editar.php';
    }
    public function actualizar(){
        $id = $_POST["id"];
        $nombre = strtoupper($_POST["nombre"]);
        $box = new Box_model();
        $box->modificarBox($id, $nombre);
        $data["titulo"] = "BOX";
        $this->index();
    }
    public function eliminar($id){
        $box = new Box_model();
        $box->eliminarBox($id);
        $data["titulo"] = "BOX";
        $this->index();
    }
}
?>