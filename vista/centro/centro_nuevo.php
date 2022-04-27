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

        <form action="index.php?c=centro&a=guardar" method="POST" autocomplete="off">
        <br><br><br><br>
                <label >NOMBRE: </label>
                <input type="text" required name="nombre" placeholder="Ingresa centro"/><br><br>
                <label >DIRECCION: </label>        
                <input type="text" required name="direccion" placeholder="Ingresa direccion" /><br><br>
                <label >ENCARGADO: </label>
                <!-- SELECT QUE CARGA LOS USUARIOS ENCARGADOS Y ADMINISTRADOR NO ASI LOS SOLOREAD -->
                <select name="usuario" id="categoriacss" required>
                <option value="" selected  > -- seleccione un encargado -- </option>
                    <?php
                        foreach($data["usuario"] as $dato){
                            echo "<option  value=".$dato['id_usuario'].">".$dato['correo']."</option>";
                        }
                    ?>
                </select>
                <br><br><br><br>

                <input type="submit" value="CREAR CENTRO"/>
        </form> 
        </div>
</div>
<!-- INCLUIR ARCHIVO PIE.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>