<?php 
    require 'modelo/Departamento_model.php';
    // require '../modelo/Departamento_model.php';
    $departamento = new Departamento_model();
    $idcentro = $_POST['idcentro'];
    $consulta = $departamento->listar_combo_departamento($idcentro);
    
    $cadena = "<select required id='lista22' name='lista22'  onchange='listar_combo_box(this.value)'>";
    
    if($idcentro == 0){
        $cadena= $cadena.'<option value="0">No existen box</option>';
    }else{
        if(mysqli_num_rows($consulta) == 0){
            $cadena= $cadena.'<option value="0">No existen departamentos</option>';
        }else{
            $cadena= $cadena.'<option value="0">-- Seleccione un depatamento --</option>';
            while($row = mysqli_fetch_row($consulta)){
                $cadena= $cadena.'<option value='.$row[0].'>'.$row[1].'</option>';
            }
        }
 
    }
    echo $cadena."</select>";
   

?>