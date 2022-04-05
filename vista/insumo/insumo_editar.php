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
        <input type="hidden" name="id" id="id" value="<?php echo $data["id"] ?>" />
        <input type="hidden" name="boxantiguo" id="boxantiguo" value="<?php echo $data["insumo"]["id_box"] ?>" />
        <label >MARCA      : </label>
        <input type="text" required name="marca" value="<?php echo $data["insumo"]["marca"] ?>" /><br><br>
        <label >MODELO     : </label>
        <input type="text" required name="modelo" value="<?php echo $data["insumo"]["modelo"] ?>" /><br><br>
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
            if(isset($ididalmacenamiento)){?>
                <input type="hidden"  name="idalmacenamientoantiguo" value="<?php echo $ididalmacenamiento?>" readonly/>
        <?php } ?>

        
        
                <div id="divselect">
                   

                     
                    <input type="submit" id="btninsumo" name="btncrear" value="GUARDAR" style=" border-radius:5px"/>
                    <br>
                    <?php if($data["insumo"]["id_categoria"] == 1 || $data["insumo"]["id_categoria"] == 2 || $data["insumo"]["id_categoria"] == 3 || $data["insumo"]["id_categoria"] == 4 || $data["insumo"]["id_categoria"] == 5 || $data["insumo"]["id_categoria"] == 9 || $data["insumo"]["id_categoria"] == 10 || $data["insumo"]["id_categoria"] == 11 ){ ?>
                            <label >UBICACION: </label>
                        <!-- combobox para seleccionar el centro donde se quiere agregar un nuevo insumo -->
                        <select name="lista1" id="lista1" required onChange="departament(this.value)"> 
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

                <?php
            if($data["insumo"]["id_categoria"] == 1 || $data["insumo"]["id_categoria"] == 2){?>
<!-- ----------------------------------SELECTORES DE COMPONENTE------------------------------------------ -->
                <div id="contenidooculti">
                    <label >Procesador:   </label>
                        <select name="procesador" id="procesador">
                            <?php
                            if(empty($idcpu)){
                                echo "<option selected value=''>No asignado</option>";
                                foreach($data["cpu"] as $dato){
                                    if($dato['id_insumo'] ==  $idcpu){
                                        echo "<option hidden value=".$ididcpu."></option>";
                                    }else{
                                        echo "<option value=".$ididcpu["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
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
                            }
                            ?>
                        </select>
    <!-- --------------------------------------------RAM------------------------------------------------------------------------- -->     
                        <label >RAM:   </label>
                        <select name="ram">
                        <?php 
                        if(empty($idram)){
                            echo "<option selected value=''>No asignada</option>";
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
                        }
                        ?>
                        </select>       
    <!-- -----------------------------------------ALMACENAMIENTO-------------------------------------------------------------------------------- -->
                        <label >Almacenamiento:   </label>
                        <select name="almacenamiento">
                        <?php 
                        if(empty($idalmacenamiento)){
                            echo "<option selected value=''>No asignado</option>";
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
