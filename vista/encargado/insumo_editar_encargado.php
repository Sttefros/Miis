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
       
        
        <form action="index.php?c=insumo&a=actualizarEncargado" method="POST" autocomplete="off">
        <br><br>
        <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />
        <label >MARCA      : </label>
        <input type="text" required name="marca" value="<?php echo $data["insumo"]["marca"] ?>" readonly/><br><br>
        <label >MODELO     : </label>
        <input type="text" required name="modelo" value="<?php echo $data["insumo"]["modelo"] ?>"readonly /><br><br>
        <label >NUM SERIE  : </label>
        <input type="text" required name="serie" value="<?php echo $data["insumo"]["num_serie"] ?>" readonly/><br><br>
        <label >DESCRIPCION: </label>
        <textarea  required name="descripcion" ><?php echo $data["insumo"]["descripcion"] ?></textarea><br><br>

        <label >CATEGORIA: </label><br><br>
        <input type="text"  name="categoria" value="<?php echo $data["insumo"]["categoria"] ?>" readonly/>
        <input type="hidden"  name="categoriass" value="<?php echo $data["insumo"]["id_categoria"] ?>" readonly/>
                <div id="divselect">
                   
                    <input type="submit" id="btninsumo" name="btncrear" value="GUARDAR" style=" border-radius:5px"/>
                    <br>
                    <?php if($data["insumo"]["id_categoria"] == 1 || $data["insumo"]["id_categoria"] == 2 || $data["insumo"]["id_categoria"] == 3 || $data["insumo"]["id_categoria"] == 4 || $data["insumo"]["id_categoria"] == 5 || $data["insumo"]["id_categoria"] == 9 || $data["insumo"]["id_categoria"] == 10 || $data["insumo"]["id_categoria"] == 11|| $data["insumo"]["id_categoria"] == 12 || $data["insumo"]["id_categoria"] == 13 || $data["insumo"]["id_categoria"] == 14 || $data["insumo"]["id_categoria"] == 15 || $data["insumo"]["id_categoria"] == 16 || $data["insumo"]["id_categoria"] == 17 || $data["insumo"]["id_categoria"] == 18|| $data["insumo"]["id_categoria"] == 19 || $data["insumo"]["id_categoria"] == 20 || $data["insumo"]["id_categoria"] == 21 ){ ?>
                            <label >UBICACION: </label>
                            <input type="hidden"  name="ubicacionpervia" value="<?php echo utf8_encode($data["insumo"]["id_centro"]) ?>" readonly/>
                            <input type="hidden"  name="departamentopervio" value="<?php echo utf8_encode($data["insumo"]["id_departamento"]) ?>" readonly/>
                            <input type="hidden"  name="boxpervio" value="<?php echo utf8_encode($data["insumo"]["id_box"]) ?>" readonly/>
                        <!-- combobox para seleccionar el centro donde se quiere agregar un nuevo insumo -->
                        <select  name="lista1" id="lista1" required onChange="departament(this.value)"> 
                        <option  value="<?php echo $data["insumo"]["id_centro"]?>" selected  ><?php echo utf8_encode($data["insumo"]["ubicacion"])?></option>
                            <?php
                                foreach($data["centro"] as $dato){
                                    if($dato['id_centro'] ==  $data["insumo"]["id_centro"]){
                                        echo "<option hidden value=".$dato['id_centro']."></option>";
                                    }else{
                                        echo "<option  value=".$dato['id_centro'].">".utf8_encode($dato['nombre'])."</option>";
                                    }
                                
                                }
                            ?>
                            
                        </select>
                    
                    <?php } ?>
                    <br>
                    
                    <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un centro -->
                   <?php if( $data["insumo"]["id_categoria"]== 6 || $data["insumo"]["id_categoria"] == 7 || $data["insumo"]["id_categoria"] == 8){?>
                    
                        <?php }else {?>
                            <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un centro -->
                    <div name="select2lista" id="select2lista" >
                    </div>
                     
                            <select name="lista2" id="lista2" required onChange="departamen(this.value)"> 
                    <option  value="<?php echo $data["insumo"]["id_departamento"]?>" selected  ><?php echo $data["insumo"]["departamento"]?></option>
                        <?php
                            foreach($data["departamento"] as $dato){
                                if($dato['id_departamento'] ==  $data["insumo"]["id_departamento"]){
                                    echo "<option hidden value=".$dato['id_departamento']."></option>";
                                }else{
                                    echo "<option  value=".$dato['id_departamento'].">".$dato['nombre']."</option>";
                                }
                               

                            }
                        ?>
                    </select>
                    <br>
                    <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un departamento -->
                    <div name="select3lista" id="select3lista" >
                    </div><br>
                    <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un departamento -->
                    <select name="lista3" id="lista3" required style="overflow: hidden;text-overflow: ellipsis;"> 
                    <option  value="<?php echo $data["insumo"]["id_box"]?>" selected  ><?php echo $data["insumo"]["box"]?></option>
                        <?php
                            foreach($data["box"] as $dato){
                                if($dato['id_box'] ==  $data["insumo"]["id_box"]){
                                    echo "<option hidden value=".$dato['id_box']."></option>";
                                }else{
                                    echo "<option  value=".$dato['id_box'].">".$dato['nombre']."</option>";
                                }
                               

                            }
                        ?>
                    </select>
                            <?php   }?>
                    <br>

                </div>

               
                
        </form> 
       
</div>
<!-- INCLUIR ARCHIVO PIE.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/pie.php' ?>
<script>
    $(document).ready(function(){
        $("#lista1").change(function(evento){
            var select = document.getElementById("lista1"); /*Obtener el SELECT */
            var valor = select.options[select .selectedIndex].value; /* Obtener el valor */ 
            listar_combo_departamento(valor);
        });
        
    });
    $(document).on('change','#rol',function(){
        var select = document.getElementById("lista1"); /*Obtener el SELECT */
        departament(select);

    })

    
    function departamen(select){
        // alert(select);
        hide1();
        listar_combo_box(select);
    }
    function departament(select){
        // alert(select);
            hide();
            hide1();
            listar_combo_departamento(select);
    }

    function hide() {
        document.getElementById("lista2").style.display = "none";
    }
    function hide1() {
        document.getElementById("lista3").style.display = "none";
    }
</script>
