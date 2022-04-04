<?php
class Categoria_model{

    private $db;
    private $categorias;


    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function get_categorias(){
        $sql = "SELECT * FROM categoria";
        $resultado = $this->db->query($sql);

        while($row = $resultado->fetch_assoc()){
            $this->categorias[] = $row;
        }
        return $this->categorias;
    }


    public function get_cate($id){
        $sql = "SELECT * FROM categoria_dispositivo WHERE id = '$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
}
?>