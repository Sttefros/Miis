<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
    <h1><?php echo $data["titulo"]?></h1>
    <br><br>
    <div id="containerform">
        <form action="index.php?c=box&a=actualizar" method="POST" autocomplete="off">
        <br><br>
        <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />

                    <label>Nombre del box: </label><input required type="text" id="nombre" name="nombre" value="<?php echo $data["box"]["nombre"] ?>" /><br><br>
                    
            
                    <label>Departamento: </label>
                    <select name="departamento" id="categoriacss" required>
                        <option value="<?php echo $data["box"]["id_departamento"]?>" selected  > <?php echo $data["box"]["departamento"]?> </option>
                            <?php
                                foreach($data["departamento"] as $dato){
                                    if($dato['id_departamento'] ==  $data["box"]["id_departamento"]){
                                        echo "<option hidden value=".$dato['id_departamento']."></option>";
                                    }else{
                                        echo "<option  value=".$dato['id_departamento'].">".$dato['nombre']."</option>";
                                    }
                                    

                                }
                            ?>
                        </select>
                        <br><br><br><br><br><br>
                    <input type="submit" value="GUARDAR CAMBIOS"/>
            </form> 
    </div>
</div>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>