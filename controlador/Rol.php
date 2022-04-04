<?php
class RolController{

    public function __construct(){
        require_once 'modelo/Rol_model.php';
    }
    public function index(){
        $rol = new Rol_model();
        $data["titulo"] = "Roles de usuario";
        $data["rol"] = $rol->getRoles();
        require_once 'vista/rol/rol.php';
    }
}




?>