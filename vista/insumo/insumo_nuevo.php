<!-- INCLUIR ARCHIVO CABECERA.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/cabecera.php'?>
<!-- INCLUIR ARCHIVO LATERAL.PHP -->
<?php require_once 'C:/wamp64/www/miis/vista/includes/lateral.php'?>
<!-- CAJA PRINCIPAL -->
<div class="container">
    <!-- TITULO -->
    <h1><?php echo $data["titulo"]?></h1>

        <!-- <div class="checkbox">
                <label><input type="checkbox" id="cbox1" selected value="first_checkbox" onclick="verComponentes();"> agregar componentes</label><br>
                <label><input type="checkbox" id="cbox2" selected value="first_checkbox" onclick="verPerifericos();"> agregar perifericos</label><br>
        </div> -->
        
        <form action="index.php?c=insumo&a=guardar" method="POST" autocomplete="off">
        <br><br>
        <label >MARCA      : </label>
        <input type="text" required name="marca" placeholder="Ingresa marca"/><br><br>
        <label >MODELO     : </label>
        <input type="text" required name="modelo" placeholder="Ingresa modelo"/><br><br>
        <label >NUM SERIE  : </label>
        <input type="text" required name="serie" placeholder="Ingresa n° serie"/><br><br>
        <label >DESCRIPCION: </label>
        <textarea  required name="descripcion" placeholder="Ingresa descripcion"></textarea><br><br>
         <!-- combobox para seleccionar la catgoria del dispositivo -->
         <select name="categoria" id="categoriainsumo" required onChange="mostrardiv(this.value)">
                    <option value="" selected  > -- seleccione una categoria -- </option>
                        <?php
                            foreach($data["categoria"] as $dato){
                                echo "<option  value=".$dato['id_categoria'].">".$dato['nombre']."</option>";

                            }
                        ?>
                    </select>
                <div id="divselect">
                    
                    <input type="submit" id="btninsumo" name="btncrear" value="GUARDAR INSUMO"/>
                    <br>
                    <label>UBICACION</label>
                    <!-- combobox para seleccionar el centro donde se quiere agregar un nuevo box -->
                    <select name="lista1" id="lista1" required > 
                    <option  value="" selected  > -- seleccione una centro -- </option>
                        <?php
                            foreach($data["centro"] as $dato){
                                echo "<option  value=".$dato['id_centro'].">".utf8_encode($dato['nombre'])."</option>";

                            }
                        ?>
                    </select>
                    <br>
                    <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un centro -->
                    <div name="select2lista" id="select2lista" >
                    </div>
                    <br>
                    <!-- div contenedor de combobox de departamento autocargado por jquery al seleccionar un departamento -->
                    <div name="select3lista" id="select3lista" >
                    </div>
                    <br>
                </div>

<!-- ----------------------------------SELECTORES DE PERIFERICOS------------------------------------------ -->
                <div id="contenidooculti" style="display: none">
                
                     <!-- ----------------------------------------PROCESADOR------------------------------------------------------------------------- -->
                    <label >Procesador:   </label>
                        <select name="procesador" id="procesador">
                        <option  value="" selected  >      -- seleccione un procesador -- </option>
                            <?php
                                foreach($data["cpu"] as $dato){
                                    echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                                }

                            ?>
                        </select>
    <!-- --------------------------------------------RAM------------------------------------------------------------------------- -->
                    <label >RAM 1:   </label>
                        <select name="ram">
                        <option  value="" selected  >     -- seleccione una ram -- </option>
                        <?php 
                            foreach($data["ram"] as $dato){
                                echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                            }
                        ?>
                        </select> 
                        <label >RAM 2:   </label>
                        <select name="ram2">
                        <option  value="" selected  >     -- seleccione una ram -- </option>
                        <?php 
                            foreach($data["ram"] as $dato){
                                echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                            }
                        ?>
                        </select>       
    <!-- -----------------------------------------ALMACENAMIENTO-------------------------------------------------------------------------------- -->
                    <label >Almacenamiento:   </label>
                        <select name="almacenamiento">
                        <option  value="" selected  > -- seleccione un almacenamiento -- </option>
                        <?php foreach ($data["almacenamiento"] as $dato){
                            echo "<option value=".$dato["id_insumo"].">".$dato["marca"]." ".$dato["num_serie"]."</option>";
                        }
                        ?>
                        </select>     
                </div>
    <!-- -------------------------------------------SELECTOR COMPONENTES------------------------------------------------------------------------ -->
                <div id="contenidooculto">
                    
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
            // alert(valor);
        });
        
    });
</script>
<script type="text/javascript">
    // function verComponentes(){
    //     if(document.getElementById('contenidooculto').style.display == 'block'){
    //         document.getElementById('contenidooculto').style.display='none';
    //     }else{
    //         document.getElementById('contenidooculto').style.display='block';
    //         document.getElementById('botoncrearinsumo').style.display='block';
    //     }
    // }
    // function verPerifericos(){
    //     if(document.getElementById('contenidoocult').style.display == 'block'){
    //         document.getElementById('contenidoocult').style.display='none';
    //     }else{
    //         document.getElementById('contenidoocult').style.display='block';
    //         document.getElementById('botoncrearinsumo').style.display='block';
    //     }
    // }
    function mostrardiv($id){
        if($id == 1 || $id == 2){
            document.getElementById('contenidooculti').style.display='block';
            document.getElementById('contenidooculto').style.display='block';
        }else{
            document.getElementById('contenidooculti').style.display='none';
            document.getElementById('contenidooculto').style.display='none';
        }
    }
</script>