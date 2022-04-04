<?php

Class Historial_model{

    private $db;
    private $historial;

    public function __construct(){
        $this->db = Conectar::conexion();
    }
    public function get_historial(){
        $consulta = "SELECT h.*,
                        u.correo as 'usuario',
                        i.id_insumo as 'insumo',
                        c.nombre as 'centro',
                        d.nombre as 'departamento',
                        b.nombre as 'box',
                        l.nombre AS 'categoria'
                    FROM historial h
                    INNER JOIN usuario u ON h.usuario_entrega = u.id_usuario
                    LEFT JOIN insumo i ON h.id_insumo = i.id_insumo
                    INNER JOIN centro c ON h.centro = c.id_centro
                    INNER JOIN departamento d ON d.id_departamento = h.departamento
                    INNER JOIN box b ON b.id_box = h.box
                    INNER JOIN categoria l ON i.id_categoria = l.id_categoria";

        $resultado = $this->db->query($consulta);

        while($row = $resultado->fetch_assoc()){
            $this->historial[] = $row;
        }
        return $this->historial;
    }
    public function get_historial_encargado($id){
        $consulta = "SELECT h.*,
                        u.correo as 'usuario',
                        i.id_insumo as 'insumo',
                        c.nombre as 'centro',
                        d.nombre as 'departamento',
                        b.nombre as 'box',
                        l.nombre AS 'categoria'
                    FROM historial h
                    INNER JOIN usuario u ON h.usuario_entrega = u.id_usuario
                    LEFT JOIN insumo i ON h.id_insumo = i.id_insumo
                    INNER JOIN centro c ON h.centro = c.id_centro
                    INNER JOIN departamento d ON d.id_departamento = h.departamento
                    INNER JOIN box b ON b.id_box = h.box
                    INNER JOIN categoria l ON i.id_categoria = l.id_categoria
                    WHERE c.id_centro = '$id'";

        $resultado = $this->db->query($consulta);

        while($row = $resultado->fetch_assoc()){
            $this->historial[] = $row;
        }
        return $this->historial;
    }
    public function insertarHistorial($id=null,$usuario, $lasid, $id_categoria, $id_centro, $id_departamento,$id_box){
        $resulta = $this->db->query("INSERT INTO historial (id_historial,fecha_accion,usuario_entrega,id_insumo,categoria,centro,departamento,box) VALUE (null, CURDATE( ),'$usuario', '$lasid', '$id_categoria', '$id_centro', '$id_departamento','$id_box')");
    }
    
    
}
?>