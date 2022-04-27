<?php
class Rol_model{

private $db;
private $rol;


public function __construct(){
    $this->db = Conectar::conexion();
}
public function getRoles(){
    $sql = "SELECT * FROM rol WHERE id_rol != 4";
    $resultado = $this->db->query($sql);

    while($row = $resultado->fetch_assoc()){
        $this->rol[] = $row;
    }
    return $this->rol;
}
}
?>