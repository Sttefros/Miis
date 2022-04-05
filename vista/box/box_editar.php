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

        <label>Centro al que pertenece: </label>
        <input  value="<?php echo $data["box"]["centro"] ?>"  readonly/><br><br>
        <label>Departamento: </label>
        <input  value="<?php echo $data["box"]["departamento"] ?>" readonly/><br><br>

                    <label>Nombre del box: </label><input required type="text" id="nombre" name="nombre" value="<?php echo $data["box"]["nombre"] ?>" /><br><br>
                    
                    
                        <br><br><br><br><br><br>
                    <input type="submit" value="GUARDAR CAMBIOS"/>
            </form> 
    </div>
</div>
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>