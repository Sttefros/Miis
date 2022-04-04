<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
    <h1><?php echo $data["titulo"]?></h1>
    <div id="containerform">
        <form action="index.php?c=departamento&a=guardar" method="POST" autocomplete="off">
        <br><br><br><br>
        <label >Seleccione centro: </label><select name="centro" id="categoriacss" required>
            <option value="" selected> -- seleccione un centro -- </option>
                <?php
                    foreach($data["centros"] as $dato){
                        echo "<option  value=".$dato['id_centro'].">".utf8_encode($dato['nombre'])."</option>";
                    }
                ?>  
        </select>
        <br><br><br><br>
        <label >Nombre departamento: </label><input type="text" required name="nombre" placeholder="Ingresa departamento"/><br><br>    
        <br><br><br><br><input type="submit" name="btncrear" value="GUARDAR DEPARTAMENTO"/>
        </form> 
    </div>
</div>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>