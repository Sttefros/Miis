<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
<h1><?php echo $data["titulo"]?></h1>

<div id="containerform">
        <form action="index.php?c=box&a=guardar" name="f1" method="POST" autocomplete="off">
        <br><br>
                <!-- combobox para seleccionar el centro donde se quiere agregar un nuevo box -->
                <label >Seleccione centro: </label><select name="lista1" id="lista1" required > 
                <option  value="" selected  > -- seleccione una centro -- </option>
                    <?php
                        foreach($data["centros"] as $dato){
                            echo "<option  value=".$dato['id_centro'].">".utf8_encode($dato['nombre'])."</option>";

                        }
                    ?>
                </select>
                <br><br>
                <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un centro -->
                <div name="select2lista" id="select2lista" >
                </div>
                <br><br>
                <!-- input para recger el nombre del box u oficina a crear -->
                <label>Nombre del box: </label><input type="text" required name="nombre" style="width:200px"placeholder="Ingresa nombre  EJ: Box 1"/><br><br>
                <br><br><br><br>
                <input type="submit" name="btncrear" value="CREAR BOX"/>
                
        </form> 
</div>
        <?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>
<script>
    $(document).ready(function(){
    $("#lista1").change(function(evento){
        var select = document.getElementById("lista1"); /*Obtener el SELECT */
        var valor = select.options[select .selectedIndex].value; /* Obtener el valor */ 
        listar_combo_departamento(valor);
        // alert(valor);
    });
    }); 
</script>