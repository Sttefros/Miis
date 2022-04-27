<?php
class LoginController{

    public function __construct(){
        require_once 'modelo/Usuario_model.php';
        require_once 'modelo/Insumo_model.php';
    }

    public function index(){
        $usuario = new Usuario_model();
        require_once 'vista/login.php';
    }
    public function login(){
        session_start();
        $correo = strtoupper($_POST["correo"]);
        $password = $_POST["password"];
        $usuario = new Usuario_model();
        $insumo = new Insumo_model();
        $usuario->getUsuarioCorreo($correo,$password);
        
        if(isset($_SESSION['administrador'])){
            // $data["titulo"] = "Usuarios";
            // $data["usuario"] = $usuario->getUsuarios();
            // require_once 'vista/usuario/usuario.php';
            $insumo = new Insumo_model();
            $data["titulo"] = "Insumos";
            $data["insumo"] = $insumo->get_insumos();
            require_once 'vista/insumo/insumo.php';
        }else if(isset($_SESSION['sololectura'])){
            // $data["titulo"] = "Usuarios";
            // $data["usuario"] = $usuario->getUsuarios();
            // require_once 'vista/usuario/usuario.php';
            $insumo = new Insumo_model();
            $data["titulo"] = "Insumos";
            $data["insumo"] = $insumo->get_insumos();
            require_once 'vista/insumo/insumo.php';
        }else if(isset($_SESSION['encargado'])){
            $insumos = new Insumo_model();
            $data["titulo"] = "Dispositivos";
            $data["insumo"] = $insumos->get_insumos_encargado($_SESSION['encargado']['id_usuario']);
            require_once 'vista/encargado/insumo_encargado.php';
        }else if(isset($_SESSION['error_login'])){
            $this->index();
        }
        


        
    }

    public function logout() {
        session_start();
        if(isset($_SESSION['administrador'])){
            unset($_SESSION['administrador']);
            session_destroy();
            header("Location: index.php");
        }else if(isset($_SESSION['sololectura'])){
            unset($_SESSION['sololectura']);
            session_destroy();
            header("Location: index.php");
        }else if(isset($_SESSION['encargado'])){
            unset($_SESSION['encargado']);
            session_destroy();
            
        }
    }
}  
?>