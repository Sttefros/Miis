<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
    <h1><?php echo $data["titulo"]?></h1>
<div id="containerform">
        <form action="index.php?c=departamento&a=actualizar" method="POST" autocomplete="off">
                <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>"  />
                <br><br><br><br>
                <label >Centro al que pertenece: </label>
                <input  value="<?php echo utf8_encode($data["departamento"]["centro"]) ?>" readonly/>
                
                <br><br><br><br>
                <label >Nombre del departamento: </label><input type="text" name="nombre" id="nombre" value="<?php echo $data["departamento"]["nombre"] ?>" required/><br><br>
                <br><br><br><br><input type="submit" value="GUARDAR CAMBIOS"/>
        </form> 
</div>
</div>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>