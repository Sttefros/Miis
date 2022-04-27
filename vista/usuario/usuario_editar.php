<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    
 if(!isset($_SESSION['administrador'])){
    if(!isset($_SESSION['encargado'])){
        if(!isset($_SESSION['sololectura'])){
            header('Location: http://localhost/miis/');
        }
    }
 }
 if(time() - $_SESSION['time'] > 1200) {
    header('Location: http://localhost/miis/');
 }
?>
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

        <form action="index.php?c=usuario&a=actualizar" method="POST" autocomplete="off">
        <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />

        <br><br><label >RUT usuario: </label><input type="text" id="rut" name="rut" value="<?php echo $data["usuario"]["rut"] ?>" /><br><br>
                <label >Password usuario: </label><input type="password"  id="password" name="password" value="<?php echo substr($data["usuario"]["password"],0,15) ?>" /><br><br>
                <label >Telefono usuario: </label><input type="text" id="telefono" name="telefono" value="<?php echo $data["usuario"]["telefono"] ?>" /><br><br>
                <label >Correo usuario: </label><input type="text" id="correo" name="correo" value="<?php echo $data["usuario"]["correo"] ?>" /><br><br>
                <label >Rol usuario: </label><select name="rol" id="categoriacss" required>
                        <option value="<?php echo $data["usuario"]["id_rol"]?>" selected  > <?php echo $data["usuario"]["rol"]?> </option>
                            <?php
                                if($data["usuario"]["id_rol"] == 4){
                                }else{
                                    foreach($data["rol"] as $dato){
                                        if($dato['id_rol'] ==  $data["usuario"]["id_rol"]){
                                            echo "<option hidden value=".$dato['id_rol']."></option>";
                                        }else{
                                            echo "<option  value=".$dato['id_rol'].">".$dato['nombre_rol']."</option>";
                                        }
                                        
    
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