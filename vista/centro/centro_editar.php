<!-- INCLUIR ARCHIVO CABECERA.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<!-- INCLUIR ARCHIVO LATERAL.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
    <!-- TITULO -->
    <h1><?php echo $data["titulo"]?></h1>
    <!-- CONTENEDOR FORMULARIO -->
    <div id="containerform">

    <form action="index.php?c=centro&a=actualizar" method="POST" autocomplete="off">
    <br><br><br><br><input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />
            <label >NOMBRE: </label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $data["centro"]["nombre"] ?>" /><br><br>
            <label >DIRECCION: </label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $data["centro"]["direccion"] ?>" /><br><br>
            <label >ENCARGADO: </label>
             <!-- SELECT QUE CARGA LOS USUARIOS ENCARGADOS Y ADMINISTRADOR NO ASI LOS SOLOREAD -->
            <select name="encargado" id="categoriacss" required>
                <option value="<?php echo $data["centro"]["id_usuario"]?>" selected ><?php echo $data["centro"]["encargado"]?></option>
                    <?php
                        foreach($data["usuario"] as $dato){
                            if($dato['id_usuario'] ==  $data["centro"]["id_usuario"]){
                                echo "<option hidden value=".$dato['id_usuario']."></option>";
                            }else{
                                echo "<option  value=".$dato['id_usuario'].">".$dato['correo']."</option>";
                            }
                        }
                    ?>
                </select>
                <br><br><br><br>

                <input type="submit" value="GUARDAR CAMBIOS"/>
            </form> 
        </div>
</div>
<!-- INCLUIR ARCHIVO PIE.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>