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
       
        
        <form action="index.php?c=insumo&a=actualizar" method="POST" autocomplete="off">
        <br><br>
        <div id="divinsumonuevo">
        <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />
        <input type="hidden" name="boxantiguo" id="boxantiguo" value="<?php echo $data["insumo"]["id_box"] ?>" />
        <label >MARCA      : </label>
        <input type="text" required name="marca" value="<?php echo $data["insumo"]["marca"] ?>" readonly /><br><br>
        <label >MODELO     : </label>
        <input type="text" required name="modelo" value="<?php echo $data["insumo"]["modelo"] ?>" readonly/><br><br>
        <label >NUM SERIE  : </label>
        <input type="text" required name="serie" value="<?php echo $data["insumo"]["num_serie"] ?>" readonly/><br><br>
        <label >DESCRIPCION: </label>
        <textarea  required name="descripcion" ><?php echo $data["insumo"]["descripcion"] ?></textarea><br><br>

        <label >CATEGORIA: </label><br><br>
        <input type="text"  name="categoria" value="<?php echo $data["insumo"]["categoria"] ?>" readonly/>
        <input type="hidden"  name="categoriass" value="<?php echo $data["insumo"]["id_categoria"] ?>" readonly/>
        <?php 
            if(isset($ididcpu)){?>
                <input type="hidden"  name="idcpuantigua" value="<?php echo $ididcpu?>" readonly/>
        <?php } ?>
        <?php 
            if(isset($ididram)){?>
                <input type="hidden"  name="idramantigua" value="<?php echo $ididram ?>" readonly/>
        <?php } ?>
        <?php 
            if(isset($ididram2)){?>
                <input type="hidden"  name="idramantigua2" value="<?php echo $ididram2 ?>" readonly/>
        <?php } ?>
        <?php 
            if(isset($ididalmacenamiento)){?>
                <input type="hidden"  name="idalmacenamientoantiguo" value="<?php echo $ididalmacenamiento?>" readonly/>
        <?php } ?>
        </div>

        <input type="hidden" name="lista2" value="<?php echo $data["insumo"]["id_departamento"]?>" readonly>
        <input type="hidden" name="lista3" value="<?php echo $data["insumo"]["id_box"]?>" readonly>
        
                <div id="divselect">
                   

                     
                    <input type="submit" id="btninsumo" name="btncrear" value="GUARDAR" style=" border-radius:5px"/>
                    <br>
                    <?php if($data["insumo"]["id_categoria"] == 1 || $data["insumo"]["id_categoria"] == 2 || $data["insumo"]["id_categoria"] == 3 || $data["insumo"]["id_categoria"] == 4 || $data["insumo"]["id_categoria"] == 5 || $data["insumo"]["id_categoria"] == 9 || $data["insumo"]["id_categoria"] == 10 || $data["insumo"]["id_categoria"] == 11 || $data["insumo"]["id_categoria"] == 12 || $data["insumo"]["id_categoria"] == 13 || $data["insumo"]["id_categoria"] == 14 || $data["insumo"]["id_categoria"] == 15 || $data["insumo"]["id_categoria"] == 17 || $data["insumo"]["id_categoria"] == 18 || $data["insumo"]["id_categoria"] == 19 || $data["insumo"]["id_categoria"] == 20 || $data["insumo"]["id_categoria"] == 21){ ?>
                            <label >UBICACION: </label>
                        <!-- combobox para seleccionar el centro donde se quiere agregar un nuevo insumo -->
                        <select name="lista1" id="lista1" required onChange="departament(this.value)" > 
                        <option  value="<?php echo $data["insumo"]["id_centro"]?>" selected  ><?php echo utf8_encode($data["insumo"]["ubicacion"])?></option>
                           
                            
                        </select>
                    
                    <?php } ?>
                    <br>

                </div>

                <?php
            if($data["insumo"]["id_categoria"] == 1 || $data["insumo"]["id_categoria"] == 2){?>
<!-- ----------------------------------SELECTORES DE COMPONENTE------------------------------------------ -->
                <div id="contenidooculti">
                    <label >Procesador:   </label>
                        <select name="procesador" id="procesador" >
                            <?php
                            if(empty($idcpu)){
                                echo "<option selected value=''>Dejar slot libre</option>";
                                foreach($data["cpu"] as $dato){
                                    if($dato['id_insumo'] ==  $idcpu){
                                        echo "<option hidden value=".$ididcpu."></option>";
                                    }else{
                                        echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                    }
                                   
                                }
                            }else{
                                echo "<option selected value=".$ididcpu.">".$marcacpu." ".$numseriecpu."</option>";
                                foreach($data["cpu"] as $dato){
                                       if($dato['id_insumo'] ==  $ididcpu){
                                            echo "<option hidden value=".$ididcpu."></option>";
                                       }else{
                                            echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                       }
                                }
                                echo "<option value=''>Dejar slot libre</option>";
                            }
                            ?>
                        </select>
    <!-- --------------------------------------------RAM------------------------------------------------------------------------- -->     
                        <label >RAM 1:   </label>
                        <select name="ram" id="ram" >
                        <?php 
                        if(empty($idram)){
                            echo "<option selected value=''>Dejar slot libre</option>";
                            foreach($data["ram"] as $dato){
                                if($dato['id_insumo'] ==  $ididram){
                                    echo "<option hidden value=".$ididram."></option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                               
                            }
                        }else{
                            echo "<option selected value=".$ididram.">".$marcaram." ".$numserieram."</option>";
                            foreach($data["ram"] as $dato){
                                if($dato['id_insumo'] ==  $ididram){
                                    echo "<option hidden value=".$ididram."></option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                               
                            }
                            echo "<option value=''>Dejar slot libre</option>";
                        }
                        ?>
                        </select>       
                        <label >RAM 2:   </label>
                        <select name="ram2" id="ram2">
                        <?php 
                        if(empty($idram2)){
                            echo "<option selected value=''>Dejar slot libre</option>";
                            foreach($data["ram"] as $dato){
                                if($dato['id_insumo'] ==  $ididram2){
                                    echo "<option hidden value=".$ididram2."></option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                               
                            }
                        }else{
                            echo "<option selected value=".$ididram2.">".$marcaram2." ".$numserieram2."</option>";
                            foreach($data["ram"] as $dato){
                                if($dato['id_insumo'] ==  $ididram2){
                                    echo "<option hidden value=".$ididram2."></option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                               
                            }
                            echo "<option value=''>Dejar slot libre</option>";
                        }
                        ?>
                        </select>    
    <!-- -----------------------------------------ALMACENAMIENTO-------------------------------------------------------------------------------- -->
                        <label >Almacenamiento:   </label>
                        <select name="almacenamiento" id="almacenamiento" >
                        <?php 
                        if(empty($idalmacenamiento)){
                            echo "<option selected value=''>Dejar slot libre</option>";
                            foreach($data["almacenamiento"] as $dato){
                                if($dato['id_insumo'] ==  $ididalmacenamiento){
                                    echo "<option hidden value=".$ididalmacenamiento."></option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                               
                            }
                        }else{
                            echo "<option selected value=".$ididalmacenamiento.">".$marcaalmacenamiento." ".$numseriealmacenamiento."</option>";
                            foreach ($data["almacenamiento"] as $dato){
                                if($dato['id_insumo'] ==  $ididalmacenamiento){
                                    echo "<option hidden value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }else{
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }
                            }
                            echo "<option value=''>Dejar slot libre</option>";
                        }
                        ?>
                        </select>      
                </div>
    <!-- -------------------------------------------SELECTOR COMPONENTES------------------------------------------------------------------------ -->
                <div id="contenidooculti2">
                
                </div>
                <?php
            }
        ?>
                
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
