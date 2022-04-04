<?php

class Centro_model {

    private $db;
    private $centro;

    public function __construct(){
        $this->db = Conectar::conexion();
        $this->centro = array();
    }

    public function getCentros(){
        // consulta de todo los centros a la base de datos
        $sql = "SELECT c.* ,
		        u.correo AS 'encargado'
                FROM centro c
                LEFT JOIN usuario u ON c.id_usuario = u.id_usuario";
        // guardar resultado de la consulta en una variable resultado
        $resultado = $this->db->query($sql);
        // hacer array associativo del resultado de la query y recorrerlo
        while($row = $resultado->fetch_assoc()){
            $this->centro[] = $row;
        }
        // retornar resultados del recorrido
        return $this->centro;
    }
    public function getCentro($id){
        $sql = "SELECT c.* ,
		u.correo as 'encargado'
        FROM centro c
        INNER JOIN usuario u ON c.id_usuario = u.id_usuario
        WHERE c.id_centro = '$id'";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
    public function getIdCentro($id){
        $consulta = "SELECT * FROM centro WHERE id_usuario = '$id'";
        $resultado = $this->db->query($consulta);
        $row = $resultado->fetch_assoc();
        return $row;
    }
    public function insertarCentro($id = null, $nombre, $direccion , $encargado){
        $validarNombre = "SELECT COUNT(nombre) AS 'nomb'
                            FROM centro WHERE nombre = '$nombre'";
        $resultado = $this->db->query($validarNombre);
        $row = $resultado->fetch_assoc();

        $validarDireccion = "SELECT COUNT(direccion) AS 'ubi'
                            FROM centro WHERE direccion = '$direccion'";
        $resultado1 = $this->db->query($validarDireccion);
        $row1 = $resultado1->fetch_assoc();

        if($row['nomb'] > 0){
            $_SESSION['error_registro'] = "¡Vaya!, este centro ya esta registrado 💔";
        }elseif($row1['ubi'] > 0){
            $_SESSION['error_registro'] = "¡Vaya!, esta direccion ya esta registrada 💔";
        }else{
            $resultado = $this->db->query("INSERT INTO centro (id_centro,nombre,direccion, id_usuario) VALUES (null, '$nombre','$direccion','$encargado')");
        }
    }
    public function modificarCentro($id , $nombre, $direccion, $encargado){
        $resultado = $this->db->query("UPDATE centro SET nombre='$nombre', direccion='$direccion', id_usuario='$encargado' WHERE id_centro = $id");
    }
    public function eliminarCentro($id){
        $consulta = "SELECT d.*,
                            (SELECT COUNT(*)
                            FROM insumo
                            WHERE id_centro = $id ) AS 'dispositivos'
                        FROM centro d
                        ORDER BY d.id_centro ASC";

        $resultado = $this->db->query($consulta);
        $row = $resultado->fetch_assoc();
        if($row['dispositivos'] > 0){
            
        }else{
            $resultado = $this->db->query("DELETE FROM centro WHERE id_centro = $id");
        }
    }
}

?>