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
<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
        <h1><?php echo $data["titulo"]?></h1>
            
  
        <div id="containerform">
            <form action="index.php?c=usuario&a=guardar" method="POST" autocomplete="off">
            <br><br><label >RUT usuario: </label></label><input type="text" required name="rut" placeholder="Ingresa rut"/><br><br>
                    <label >Password usuario: </label><input type="text" required name="password" placeholder="Ingresa password"/><br><br>
                    <label >Telefono usuario: </label><input type="text" required name="telefono" placeholder="Ingresa telefono"/><br><br>
                    <label >Correo usuario: </label><input type="text" required name="correo" placeholder="Ingresa correo"/><br><br>
                    
                    <label >Rol usuario: </label><select name="rol" id="categoriacss" required>
                    <option value="" selected  > -- seleccione un rol -- </option>
                        <?php
                            foreach($data["rol"] as $dato){
                                echo "<option  value=".$dato['id_rol'].">".$dato['nombre_rol']."</option>";

                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="submit" name="btncrear" value="GUARDAR USUARIO"/>
            </form> 
        </div>
</div>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>