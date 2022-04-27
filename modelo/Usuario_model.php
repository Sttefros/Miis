<?php

class Usuario_model{

    private $db;
    private $usuarios;

    public function __construct(){
        $this->db = Conectar::conexion();
    }
    public function getUsuarios(){
        $sql = "SELECT u.* ,
                r.nombre_rol AS 'rol'
                FROM usuario u
                INNER JOIN rol r ON u.id_rol = r.id_rol";
        $resultado = $this->db->query($sql);
        while($row =$resultado->fetch_assoc()) {
            $this->usuarios[] = $row;
        }
        return $this->usuarios;
    }
    public function getUsuariosEncargado(){
        $sql = "SELECT u.* ,
                r.nombre_rol AS 'rol'
                FROM usuario u
                INNER JOIN rol r ON u.id_rol = r.id_rol
                WHERE r.id_rol = 1 OR r.id_rol = 2";
        $resultado = $this->db->query($sql);
        while($row =$resultado->fetch_assoc()) {
            $this->usuarios[] = $row;
        }
        return $this->usuarios;
    }
    public function getUsuarioCorreo($correo, $password) {
        $sql = "SELECT * FROM usuario WHERE correo = '$correo' LIMIT 1";

        $resultado = $this->db->query($sql);
        //con etch_assoc saca un array asociativo  del resultado de la query
        $row = $resultado->fetch_assoc();
        
        if($row == true){
            //comparar la contrasena del $usuario columna 'password'
            $verify = password_verify($password, $row['password']);
            // verificar el resultado de la validacion de la password
            if($verify == true){
                if($row['id_rol'] == 1 OR $row['id_rol'] == 4){
                    $_SESSION['administrador'] = $row;
                    $_SESSION['time'] = time();
                    return $_SESSION['administrador'];
                }else if($row['id_rol'] == 2){
                    $_SESSION['encargado'] = $row;
                    $_SESSION['time'] = time();
                    return $_SESSION['encargado'];
                }else if($row['id_rol'] == 3){
                    $_SESSION['sololectura'] = $row;
                    $_SESSION['time'] = time();
                    return $_SESSION['sololectura'];
                }               
            }else{
                //si algo falla enviar sesion con el fallo de verificacion de contraseña
                $_SESSION['error_login'] = "password incorrecto";
                return $_SESSION['error_login'];
            }
        }else{
            //si algo falla enviar sesion con el fallo de verificacion de correo
            $_SESSION['error_login'] = "correo incorrecto";
            return $_SESSION['error_login'];
        }
    }
    public function insertarUsuarios($id=null, $rut, $correo, $telefono, $password,$rol){        
        $validacionRut = "SELECT COUNT(rut) AS 'cantidad' FROM usuario WHERE rut = '$rut'";
        $validacioncorreo = "SELECT COUNT(correo) AS 'corre' FROM usuario WHERE correo = '$correo'";
        $resultado = $this->db->query($validacionRut);
        $resultado1 = $this->db->query($validacioncorreo);
        $row = $resultado->fetch_assoc();
        $row1 = $resultado1->fetch_assoc();
        $rest = substr($rut, -1);
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        // $regexc = "/^([K0-9])$/";
        $regexcf = "/^([0-9]{1,2}[0-9]{3}[0-9]{3}[K0-9]{1})$/";
        $asd = preg_match($regex, $correo);
        $dsa = preg_match($regexcf, $rut);
        if($row['cantidad'] > 0){?>
            <script>alert("El rut ya se encuentra registrado");</script><?php
        }elseif($row1['corre'] > 0){?>
            <script>alert("El correo ya se encuentra registrado");</script><?php
        }else{
            if($asd == 1){
                if($dsa == 1){
                    $resultado = $this->db->query("INSERT INTO usuario (id_usuario,rut,password,telefono,correo,id_rol) VALUES (null, '$rut', '$password', '$telefono', '$correo', '$rol')");
                }else{?>
                    <script>alert("Ingrese formato de rut correcto");</script><?php
                }
            }else{?>
                <script>alert("Ingrese formato de correo correcto");</script><?php
            }
        }
        
    }
    public function eliminarUsuario($id){
        $validacionUsuarioEncargado = "SELECT COUNT(*) FROM `centro` WHERE id_usuario = '$id'";
        $resultado = $this->db->query($validacionUsuarioEncargado);
        
        $row = $resultado->fetch_assoc();
        if($row == 0){
            $resultado = false;
        }else{
            $resultado = $this->db->query("DELETE FROM usuario WHERE id_usuario = '$id' AND id_rol != '1' AND id_rol != '4'");
        }

        if($resultado == true){?>
            <script>alert("Usuario Eliminado");</script><?php
        }else{?>
            <script>alert("Usuario mantiene un centro a su cargo");</script><?php
        }
   
    }
    public function modificarUsuario($id, $rut, $password, $telefono, $correo, $rol){
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        $regexcf = "/^([0-9]{1,2}[0-9]{3}[0-9]{3}[K0-9]{1})$/";
        $asd = preg_match($regex, $correo);
        $dsa = preg_match($regexcf, $rut);
        if($asd == 1){
            if($dsa == 1){
                $resultado = $this->db->query("UPDATE usuario SET rut = '$rut' , password = '$password', telefono = '$telefono' , correo = '$correo', id_rol = '$rol' WHERE id_usuario = '$id'");
            }else{?>
                <script>alert("Ingrese formato de rut correcto");</script><?php
            }
        }else{?>
            <script>alert("Ingrese formato de correo correcto);</script><?php
        }
    }
    public function getUsuario($id){
        $sql = "SELECT d.*, c.nombre_rol AS 'rol'
        FROM usuario d
        INNER JOIN rol c ON d.id_rol = c.id_rol
        WHERE d.id_usuario = '$id' ";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
}

?>