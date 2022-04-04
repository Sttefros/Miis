<?php
$db;
function __construct() {
    $this->db = Conectar::conexion();
}

$id = $_POST['centro'];

$sql = "SELECT * FROM departamento WHERE id_centro = '$id'";
$resultado = $this->db->query($sql);
$cadena="<label>SELECT 2 (paises)</label> 
			<select id='lista2' name='lista2'>";

	while ($ver= $resultado->mysqli_fetch_row()) {
		$cadena=$cadena.'<option value='.$ver['id_departamento'].'>'.utf8_encode($ver['nombre']).'</option>';
	}

	echo  $cadena."</select>";
?>