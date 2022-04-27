<?php
require_once 'configuracion/conexion.php';
class Departamento_model{

    private $db;
    private $departamentos;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->departamentos = array();
    }
    // OBTENER TODOS LOS DEPARTAMENTOS
    public function getDepartamentos(){
        $sql = "SELECT d.*, c.nombre as 'centro'
                FROM departamento d
                LEFT JOIN centro c ON d.id_centro = c.id_centro";
        $resultado = $this->db->query($sql);

        while ($row = $resultado->fetch_assoc()){
            $this->departamentos[] = $row;
        }
        return $this->departamentos;
    }
    // INSERTAR REGISTRO EN DEPARTAMENTO
    public function insertarDepartamento($id=null, $nombre, $centro){
        $validarNombre = "SELECT COUNT(nombre) AS 'nomb' 
                            FROM departamento WHERE nombre = '$nombre'
                            AND id_centro = '$centro'";
        $resultado =$this->db->query($validarNombre);
        $row = $resultado->fetch_assoc();
        if($row['nomb'] > 0 ){?>
            <script>alert("El departamento no pudo registrarse");</script><?php
        }else{
            $resultado = $this->db->query("INSERT INTO departamento (id_departamento,nombre,id_centro) VALUES (null, '$nombre', '$centro')");?>
            <script>alert("Departamento creado exitosamente");</script><?php
        }
    }
    // OBTENER UN DEPARTAMENTO POR SU ID
    public function getDepartamento($id){
        $sql = "SELECT d.* , c.nombre AS 'centro'
                FROM departamento d
                INNER JOIN centro c ON d.id_centro = c.id_centro
                WHERE id_departamento = '$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
    // OBTENER  DEPARTAMENTO POR SU ID
    public function getDepartamentosPorId($id){
        $sql = "SELECT d.* 
        FROM departamento d
        INNER JOIN centro c ON d.id_centro = c.id_centro
        WHERE c.id_centro = '$id' ";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()){
            $this->departamentos[] = $row;
        }
        return $this->departamentos;
    }
    // MODIFICAR REGISTRO DE DEPARTAMENTO
    public function modificarDepartamento($id, $nombre){
        $resultado= $this->db->query("UPDATE departamento SET nombre='$nombre'  WHERE id_departamento='$id'");
        if($resultado == true){?>
            <script>alert("El nombre del departamento se actualizo");</script><?php
        }
    }
    public function listar_combo_departamento($idcentro){
        $sql = "SELECT d.* 
                FROM departamento d
                WHERE d.id_centro = $idcentro
                ORDER BY d.nombre ASC";
        $resultado = $this->db->query($sql);

        // while ($row = $resultado->fetch_assoc()){
        //     $this->departamentos[] = $row;
        // }
        // return $this->departamentos;
        return $resultado;
    }
    public function eliminarDepartamento($id){
        $consulta = "SELECT d.*,
        (SELECT COUNT(*)
           FROM insumo
           WHERE id_departamento = '$id' ) AS 'dispositivos'
       FROM departamento d
       ORDER BY d.id_departamento ASC";
       $resultado = $this->db->query($consulta);
       $row= $resultado->fetch_assoc();
       if($row['dispositivos'] > 0){
           $sql = false;
        }else{
           $sql = $this->db->query("DELETE FROM departamento WHERE id_departamento = '$id'");
       }
       if($sql == true){?>
        <script>alert("Departamento Eliminado");</script><?php
       }else{?>
        <script>alert("Departamento no Eliminado, mantiene dispositivo vinculado.");</script><?php

       }
    }
}
?>