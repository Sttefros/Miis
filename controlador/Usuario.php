<?php

class UsuarioController{

    public function __construct(){
        require_once 'modelo/Usuario_model.php';
        require_once 'modelo/Rol_model.php';
    }

    public function index(){
        $usuario = new Usuario_model();
        $data["titulo"] = "Usuarios";
        $data["usuario"] = $usuario->getUsuarios();
        require_once 'vista/usuario/usuario.php';
    }
    public function nuevo(){
        $data["titulo"] = "Nuevo Usuario";
        $rol = new Rol_model();
        $data["rol"] = $rol->getRoles();
        require_once 'vista/usuario/usuario_nuevo.php';
    }
    public function guardar(){
        $id = null;
        $rut = $_POST["rut"];
        $password = $_POST["password"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $rol = $_POST["rol"];
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost'=>4]); //VERIFICAR PASS

        $rut = str_replace('.', '', $rut);
        $rut = str_replace('-', '', $rut);
        
            $usuarios = new Usuario_model();
            $usuarios->insertarUsuarios($id, $rut, $correo, $telefono, $password_segura,$rol);
       
        $data["titulo"] = "usuario";
        $this->index();
    }
    public function eliminar($id){
        $usuarios = new Usuario_model();
        $usuarios->eliminarUsuario($id);
        $data["titulo"] = "usuario";
        $this->index();
    }
    public function modificar($id){
        $usuarios = new Usuario_model();
        $rol = new Rol_model();
        $data["id"] = $id;
        $data["titulo"] = "Editar usuario";
        $data["usuario"] = $usuarios->getUsuario($id);
        $data["rol"] = $rol->getRoles();
        require_once 'vista/usuario/usuario_editar.php';
    }
    public function actualizar(){
        $id = $_POST["id"];
        $rut = $_POST["rut"];
        $password = $_POST["password"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $rol = $_POST["rol"];
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost'=>4]); //VERIFICAR PASS
        $usuarios = new Usuario_model();
        $usuarios->modificarUsuario($id, $rut, $password_segura, $telefono, $correo, $rol);

        $data["titulo"] = "Actualizar Usuario";
        $this->index();
    }
}

?>