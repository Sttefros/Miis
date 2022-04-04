<?php 
    require 'modelo/Box_model.php';
    $box = new Box_model();
    $iddepartamento = $_POST['iddepartamento'];
    $consulta = $box->listar_combo_box($iddepartamento);
    $cadena = "<select id='lista33' name='lista33'>";

        if($iddepartamento == 0){
            $cadena= $cadena.'<option value="">No existen box</option>';
        }else{
            if(mysqli_num_rows($consulta) == 0){
                $cadena= $cadena.'<option value="">No existen box</option>';
            }else{
                $cadena= $cadena.'<option value="">-- Seleccione un box --</option>';
                while($row = mysqli_fetch_row($consulta)){
                    $cadena= $cadena.'<option value='.$row[0].'>'.$row[1].'</option>';
                }
            }
        }
    echo $cadena."</select>";
   

?>