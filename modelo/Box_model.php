<?php
require_once 'configuracion/conexion.php';
    class Box_model {

        private $db;
        private $centros;

        public function __construct() {
            $this->db = Conectar::conexion();
            $this->centros = array();
        }
        public function getBoxes() {

            $consulta = "SELECT d.*, c.nombre AS 'departamento', j.nombre AS 'centro'
                        FROM box d
                        INNER JOIN departamento c ON d.id_departamento = c.id_departamento
                        INNER JOIN centro j ON c.id_centro = j.id_centro
                        ORDER BY d.id_box ASC";
            $resultado = $this->db->query($consulta);

            while($row =$resultado->fetch_assoc()) {
                $boxes[] = $row;
            }
            return $boxes;
            // echo json_encode($boxes);
        }
        public function insertarBox($id=null, $nombre, $departamento){ 
            $validacionNombre = "SELECT COUNT(nombre) AS 'nombreBox' FROM box WHERE nombre = '$nombre' AND id_departamento = '$departamento'";
            $resultado = $this->db->query($validacionNombre);
            $row = $resultado->fetch_assoc();

            if($row['nombreBox'] > 0){?>
                <script>alert("El box no pudo registrarse");</script><?php
            }else{
                $resultado = $this->db->query("INSERT INTO box  (id_box,nombre,id_departamento) VALUES (null, '$nombre', '$departamento')");?>
                <script>alert("Box creado exitosamente");</script><?php
            }
        }
        public function obtener_box($box){
            $sql = "SELECT d.*, c.nombre AS 'departamento'
                                ,	u.nombre AS 'centro'
                    FROM box d
                    INNER JOIN departamento c ON d.id_departamento = c.id_departamento
                    INNER JOIN centro u ON c.id_centro = u.id_centro
                    WHERE d.id_box = $box";

            $resultado = $this->db->query($sql);
            $row = $resultado->fetch_assoc();
           return $row;
        }
        public function modificarBox($id, $nombre){        
            $resultado = $this->db->query("UPDATE box SET  nombre='$nombre' WHERE id_box = $id");
            if($resultado == true){?>
                <script>alert("El nombre del box se actualizo");</script><?php
            }
        }

        public function listar_combo_box($iddepartamento){
            $sql = "SELECT d.* 
                    FROM box d
                    WHERE d.id_departamento = $iddepartamento";
            $resultado = $this->db->query($sql);
    
            // while ($row = $resultado->fetch_assoc()){
            //     $this->departamentos[] = $row;
            // }
            // return $this->departamentos;
            return $resultado;
        }
        public function eliminarBox($id){
            $consulta = "SELECT d.*,
                             (SELECT COUNT(*)
                                FROM insumo
                                WHERE id_box = $id ) AS 'dispositivos'
                            FROM box d
                            ORDER BY d.id_box ASC";

            $resultado = $this->db->query($consulta);
            $row = $resultado->fetch_assoc();
            if($row['dispositivos'] > 0){
                $sql = false;
            }else{
                $sql = $this->db->query("DELETE FROM box WHERE id_box = '$id'");
            }
            if($sql == true){?>
                <script>alert("Box Eliminado");</script><?php
            }else{?>
                <script>alert("Box no Eliminado, mantiene dispositivo vinculado.");</script><?php
            }
        }
    }
?>