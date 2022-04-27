<?php

Class InsumoController{
    //contructor para cargar todos los modelos de la carpeta model
    public function __construct(){
        require_once 'modelo/Insumo_model.php';
        require_once 'modelo/Centro_model.php';
        require_once 'modelo/Categoria_model.php';
        require_once 'modelo/Departamento_model.php';
        require_once 'modelo/Box_model.php';
        require_once 'modelo/Historial_model.php';
        require_once 'modelo/Usuario_model.php';
    }
    public function index(){
        $insumo = new Insumo_model();
        $data["titulo"] = "Insumos";
        $data["insumo"] = $insumo->get_insumos();
        require_once 'vista/insumo/insumo.php';
    }
    public function index1(){
        if(isset($_SESSION)){

        }else{
            session_start();
        }

        $insumo = new Insumo_model();
        $data["titulo"] = "Dispositivos";
        $data["insumo"] = $insumo->get_insumos_encargado($_SESSION['encargado']['id_usuario']);
        require_once 'vista/encargado/insumo_encargado.php';
    }
    public function nuevo(){

         // generar instancia del modelo de categorias de dispositivo y centros disponibles y departamentos
        $insumo = new Insumo_model();
        $categoria = new Categoria_model();
        $centro = new Centro_model();
        $mouse = new Insumo_model();
        $pantalla = new Insumo_model();
        $teclado = new Insumo_model();
        $cpu = new Insumo_model();
        $ram = new Insumo_model();
        $almacenamiento = new Insumo_model();
        $fuente = new Insumo_model();
        $box = new Box_model();
        $data["titulo"] = "Nuevo Insumo";
        //llamda a las funciones almacenadas en los modelos de centro y categorias
        $data["centro"] = $centro->getCentros();
        $data["categoria"] = $categoria->get_categorias();
        // llamar a las funciones para cargar la informacion de los perifericos en los select de nuevo insumo
        $data["mouse"] = $mouse->get_insumo_mouse();
        $data["pantalla"] = $pantalla->get_insumo_pantalla();
        $data["teclado"] = $teclado->get_insumo_teclado();
        // llamar a las funciones para cargar la informacion de los componentes en los select de nuevo insumo
        $data["cpu"] = $cpu->get_insumo_cpu();
        $data["ram"] = $ram->get_insumo_ram();
        $data["almacenamiento"] = $almacenamiento->get_insumo_almacenamiento();
        $data["fuente"] = $fuente->get_insumo_fuente();
        //lavada a la vista de nuevo insumo
        require_once 'vista/insumo/insumo_nuevo.php';
    }
    public function guardar(){
        // var_dump($_POST);die();
        session_start();
        $id = "null";
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        $serie = strtoupper($_POST["serie"]);
        $descripcion = strtoupper($_POST["descripcion"]);
        $id_categoria = $_POST["categoria"];
        $id_centro = $_POST["lista1"];
        $id_departamento = $_POST["lista22"];
        $id_box = $_POST["lista33"];
        $asignado = 0;
        $estado = 0;
        $id_extra = "null";
        $insumo = new Insumo_model();
        $historial = new Historial_model();
        $usuario = new Usuario_model();

        if(isset($_SESSION['administrador'])){
            $usuario = $_SESSION['administrador']['id_usuario'];
        }else if(isset($_SESSION['encargado'])){
            $usuario = $_SESSION['encargado']['id_usuario'];
        }

        if($id_categoria == 1 || $id_categoria == 2){

            $procesador = $_POST["procesador"];
            $ram = $_POST["ram"];
            $ram2 = $_POST["ram2"];
            $almacenamiento = $_POST["almacenamiento"];
            $fuente = $_POST["fuente"];

            $procesadorfinal = false;
            $almacenamientofinal = false;
            $ramfinal = false;
            $fuentefinal = false;
            $lasid = null;

            $xs = $insumo->insertarInsumoo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$id_extra,$usuario);
            $historial->insertarHistorial($id,$usuario, $xs, $id_categoria, $id_centro, $id_departamento,$id_box);

            if(isset($_POST["procesador"])){
                if($_POST["procesador"] != ""){
                    $xs = $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$procesador,$usuario);
                    $insumo->cambiarAsignadoInsumo($procesador);
                    $insumo->cambiarubicacion($ram,$id_centro,$id_departamento,$id_box);
                    $cate = $xs[1];
                    // $historial->insertarHistorial($id,$usuario, $procesador, $cate, $id_centro, $id_departamento,$id_box);
                    $procesadorfinal = true;
                }
            }
            if(isset($_POST["ram"])){
                if($_POST["ram"] != ""){
                    $xs = $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram,$usuario);
                    $insumo->cambiarAsignadoInsumo($ram);
                    $insumo->cambiarubicacion($ram,$id_centro,$id_departamento,$id_box);
                    $cate = $xs[1];
                    // $historial->insertarHistorial($id,$usuario, $ram, $cate, $id_centro, $id_departamento,$id_box);
                    $ramfinal = true;
                }
            }
            if(isset($_POST["ram2"])){
                if($_POST["ram2"] != ""){
                    if($_POST["ram2"] != $_POST["ram"]){
                        $xs = $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram2,$usuario);
                        $insumo->cambiarAsignadoInsumo($ram2);
                        $insumo->cambiarubicacion($ram2,$id_centro,$id_departamento,$id_box);
                        $cate = $xs[1];
                        // $historial->insertarHistorial($id,$usuario, $ram, $cate, $id_centro, $id_departamento,$id_box);
                        $ramfinal = true;
                    }
                }
            }
            if(isset($_POST["almacenamiento"])){
                if($_POST["almacenamiento"] != ""){
                    $xs = $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$almacenamiento,$usuario);
                    $insumo->cambiarAsignadoInsumo($almacenamiento);
                    $insumo->cambiarubicacion($ram,$id_centro,$id_departamento,$id_box);
                    $cate = $xs[1];
                    // $historial->insertarHistorial($id,$usuario, $almacenamiento, $cate, $id_centro, $id_departamento,$id_box);
                    $almacenamientofinal = true;
                }
            }
            if(isset($_POST["fuente"])){
                if($_POST["fuente"] != ""){
                    $xs = $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$fuente,$usuario);
                    $insumo->cambiarAsignadoInsumo($fuente);
                    $insumo->cambiarubicacion($fuente,$id_centro,$id_departamento,$id_box);
                    $cate = $xs[1];
                    // $historial->insertarHistorial($id,$usuario, $procesador, $cate, $id_centro, $id_departamento,$id_box);
                    $procesadorfinal = true;
                }
            }

        }else{
                $xs = $insumo->insertarInsumoo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$id_extra,$usuario);
                $historial->insertarHistorial($id,$usuario, $xs, $id_categoria, $id_centro, $id_departamento,$id_box);
            }

        $data["titulo"] = "Dispositivos";
        $this->index();
    }

    public function modificar($id){
        $insumo = new Insumo_model();
        $centro = new Centro_model();
        $departamento = new Departamento_model();
        $box = new Box_model();
        $mouse = new Insumo_model();
        $pantalla = new Insumo_model();
        $teclado = new Insumo_model();
        $cpu = new Insumo_model();
        $ram = new Insumo_model();
        $rams = new Insumo_model();
        $almacenamiento = new Insumo_model();
        $fuente = new Insumo_model();
        $data["id"] = $id;
        $data["titulo"] = "Editar insumo";
        // obtener informacion del insumo
        $data["insumo"] = $insumo->get_insumo_id($id);
        // obtener los centros de san joaquin
        $data["centro"] = $centro->getCentros();
        $data["departamento"] = $departamento->getDepartamentosPorId($data["insumo"]["id_centro"]);
        $data["box"] = $box->listar_combo_box($data["insumo"]["id_departamento"]);
        $data["extras"] = $insumo->get_insumo_serie($data["insumo"]["num_serie"]);
        $data["rams"] = $rams->get_ram_serie($data["insumo"]["num_serie"]);
        // llamar a la funcion para cargar los componentes del insumo pc o notebook

        // var_dump($data["rams"]);die();

            if(isset($data["rams"][0])){
                $ididram = $data["rams"][0]["id_extras"];
                $idram = $data["rams"][0]["idcateextra"];
                $marcaram = $data["rams"][0]["marcaextra"];
                $numserieram = $data["rams"][0]["numserieextra"];
            }
            if(isset($data["rams"][1])){
                $ididram2 = $data["rams"][1]["id_extras"];
                $idram2 = $data["rams"][1]["idcateextra"];
                $marcaram2 = $data["rams"][1]["marcaextra"];
                $numserieram2 = $data["rams"][1]["numserieextra"];
            }

            // var_dump($ididram2);die();
        if(isset($data["extras"])){
            foreach($data["extras"] as $dato){
                switch ($dato)
                {
                    case $dato["idcateextra"] == 6 :
                        $ididcpu = $dato["id_extras"];
                        $idcpu = $dato["idcateextra"];
                        $marcacpu = $dato["marcaextra"];
                        $numseriecpu = $dato["numserieextra"];
                    break;

                    // case $dato["idcateextra"] == 7:
                    //         $ididram = $dato["id_extras"];
                    //         $idram = $dato["idcateextra"];
                    //         $marcaram = $dato["marcaextra"];
                    //         $numserieram = $dato["numserieextra"];
                    // break;

                    case $dato["idcateextra"] == 8:
                        $ididalmacenamiento = $dato["id_extras"];
                        $idalmacenamiento = $dato["idcateextra"];
                        $marcaalmacenamiento = $dato["marcaextra"];
                        $numseriealmacenamiento = $dato["numserieextra"];

                    break;
                    case $dato["idcateextra"] == 16:
                        $ididfuente = $dato["id_extras"];
                        $idfuente = $dato["idcateextra"];
                        $marcafuente = $dato["marcaextra"];
                        $numseriealfuente = $dato["numserieextra"];

                    break;

                }

            }
        }
         // llamar a las funciones para cargar la informacion de los perifericos en los select de nuevo insumo
         $data["mouse"] = $mouse->get_insumo_mouse();
         $data["pantalla"] = $pantalla->get_insumo_pantalla();
         $data["teclado"] = $teclado->get_insumo_teclado();
         // llamar a las funciones para cargar la informacion de los componentes en los select de nuevo insumo
         $data["cpu"] = $cpu->get_insumo_cpu();
         $data["ram"] = $ram->get_insumo_ram();
         $data["almacenamiento"] = $almacenamiento->get_insumo_almacenamiento();
         $data["fuente"] = $fuente->get_insumo_fuente();

        require_once 'vista/insumo/insumo_editar.php';
    }
    public function modificarDadoDeBaja($id){
        $insumo = new Insumo_model();
        $centro = new Centro_model();
        $departamento = new Departamento_model();
        $box = new Box_model();
        $mouse = new Insumo_model();
        $pantalla = new Insumo_model();
        $teclado = new Insumo_model();
        $cpu = new Insumo_model();
        $ram = new Insumo_model();
        $rams = new Insumo_model();
        $almacenamiento = new Insumo_model();
        $fuente = new Insumo_model();
        $data["id"] = $id;
        $data["titulo"] = "Editar insumo";
        // obtener informacion del insumo
        $data["insumo"] = $insumo->get_insumo_id($id);
        // obtener los centros de san joaquin
        $data["centro"] = $centro->getCentros();
        $data["departamento"] = $departamento->getDepartamentosPorId($data["insumo"]["id_centro"]);
        $data["box"] = $box->listar_combo_box($data["insumo"]["id_departamento"]);
        $data["extras"] = $insumo->get_insumo_serie($data["insumo"]["num_serie"]);
        $data["rams"] = $rams->get_ram_serie($data["insumo"]["num_serie"]);
        // llamar a la funcion para cargar los componentes del insumo pc o notebook

        // var_dump($data["rams"]);die();

            if(isset($data["rams"][0])){
                $ididram = $data["rams"][0]["id_extras"];
                $idram = $data["rams"][0]["idcateextra"];
                $marcaram = $data["rams"][0]["marcaextra"];
                $numserieram = $data["rams"][0]["numserieextra"];
            }
            if(isset($data["rams"][1])){
                $ididram2 = $data["rams"][1]["id_extras"];
                $idram2 = $data["rams"][1]["idcateextra"];
                $marcaram2 = $data["rams"][1]["marcaextra"];
                $numserieram2 = $data["rams"][1]["numserieextra"];
            }

            // var_dump($ididram2);die();
        if(isset($data["extras"])){
            foreach($data["extras"] as $dato){
                switch ($dato)
                {
                    case $dato["idcateextra"] == 6 :
                        $ididcpu = $dato["id_extras"];
                        $idcpu = $dato["idcateextra"];
                        $marcacpu = $dato["marcaextra"];
                        $numseriecpu = $dato["numserieextra"];
                    break;

                    // case $dato["idcateextra"] == 7:
                    //         $ididram = $dato["id_extras"];
                    //         $idram = $dato["idcateextra"];
                    //         $marcaram = $dato["marcaextra"];
                    //         $numserieram = $dato["numserieextra"];
                    // break;

                    case $dato["idcateextra"] == 8:
                        $ididalmacenamiento = $dato["id_extras"];
                        $idalmacenamiento = $dato["idcateextra"];
                        $marcaalmacenamiento = $dato["marcaextra"];
                        $numseriealmacenamiento = $dato["numserieextra"];

                    break;
                    case $dato["idcateextra"] == 16:
                        $ididfuente = $dato["id_extras"];
                        $idfuente = $dato["idcateextra"];
                        $marcafuente = $dato["marcaextra"];
                        $numseriealfuente = $dato["numserieextra"];

                    break;

                }

            }
        }
         // llamar a las funciones para cargar la informacion de los perifericos en los select de nuevo insumo
         $data["mouse"] = $mouse->get_insumo_mouse();
         $data["pantalla"] = $pantalla->get_insumo_pantalla();
         $data["teclado"] = $teclado->get_insumo_teclado();
         // llamar a las funciones para cargar la informacion de los componentes en los select de nuevo insumo
         $data["cpu"] = $cpu->get_insumo_cpu();
         $data["ram"] = $ram->get_insumo_ram();
         $data["almacenamiento"] = $almacenamiento->get_insumo_almacenamiento();
         $data["fuente"] = $fuente->get_insumo_fuente();

        require_once 'vista/insumo/insumo_editar_de_baja.php';
    }
    public function actualizar() {
        // var_dump($_POST);die();
        session_start();
        if(isset($_SESSION['administrador'])){
            $usuario = $_SESSION['administrador']['id_usuario'];
        }else if(isset($_SESSION['encargado'])){
            $usuario = $_SESSION['encargado']['id_usuario'];
        }

        $id = $_POST["id"];
        $idd = null;
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        $descripcion = strtoupper($_POST["descripcion"]);
        $id_categoria = $_POST["categoriass"];
        $serie = strtoupper($_POST["serie"]);
        $estado = 0;
        $asignado = 0;
        // var_dump($marca);die();
        if(isset($_POST["lista11"])){
            $id_centro = $_POST["lista11"];
        }else{
            if(isset($_POST["lista1"])){
                $id_centro = $_POST["lista1"];
            }
        }
        if(isset($_POST["lista22"])){
            $id_departamento = $_POST["lista22"];
        }else{
            if(isset($_POST["lista2"])){
                $id_departamento = $_POST["lista2"];
            }
        }
        if(isset($_POST["lista33"])){
            $id_box = $_POST["lista33"];
        }else{
            if(isset($_POST["lista3"])){
                $id_box = $_POST["lista3"];
            }
        }
        if(isset($id_departamento)){
            if($id_departamento == 0){?>
                <script>alert("Debes ingresar un departamento.");</script><?php
            }
        }

        if(isset($id_box)){
            if($id_box == 0){?>
                <script>alert("Debes ingresar un box.");</script><?php
            }
        }
        if(isset($_POST["procesador"])){
                $cpu = $_POST["procesador"];
        }
        if(isset($_POST["idcpu"])){
            $cpuid = $_POST["idcpu"];
        }
        if(isset($_POST["ram"])){
            $ram = $_POST["ram"];
        }
        if(isset($_POST["ram2"])){
            $ram2 = $_POST["ram2"];
        }
        if(isset($_POST["almacenamiento"])){
            $almacenamiento = $_POST["almacenamiento"];
        }
        if(isset($_POST["fuente"])){
            $fuente = $_POST["fuente"];
        }
        $insumo = new Insumo_model();
        $historial = new Historial_model();
        switch ($_POST["categoriass"])
                {
// -------------------------------------------------------------------CATEGORIA PC ESCRITORIO-------------------------------------------------------------------------------------------

                    case $_POST["categoriass"] == 1 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
// ------------------------------------------------------------------------CPU-------------------------------------------------------------------------------------------
                        if(isset($_POST["idcpuantigua"])){
                            if($_POST["idcpuantigua"] != $_POST["procesador"]){
                                if($_POST["procesador"] != ""){
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idcpuantigua"]);
                                    $insumo->cambiarAsignadoInsumo($_POST["procesador"]);

                                    $data["xD"] = $insumo->updatearinsumoextracpu($_POST["serie"]);
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["procesador"] );
                                }else{
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idcpuantigua"]);
                                    $data["xD"] = $insumo->updatearinsumoextracpu($_POST["serie"]);
                                    $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                }
                            }
                        }else if(isset($_POST["procesador"])){
                                if($_POST["procesador"] != ""){
                                    $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$cpu,$usuario);
                                    $insumo->cambiarAsignadoInsumo($cpu);
                                }
                        }

// ------------------------------------------------------------------------RAM-------------------------------------------------------------------------------------------
                        if(isset($_POST["idramantigua"])){
                            if($_POST["idramantigua"] != $_POST["ram"]){
                                if($_POST["idramantigua"] != $_POST["ram2"]){
                                    if($_POST["ram"] != ""){
                                        $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua"]);
                                        $insumo->cambiarAsignadoInsumo($_POST["ram"]);

                                        $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua"]);
                                        $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram"] );
                                    }else{
                                        $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua"]);
                                        $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua"]);

                                        $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                    }
                                }
                            }
                        }else if(isset($_POST["ram"])){
                                if($_POST["ram"] != ""){
                                    if($_POST["ram"] != $_POST["ram2"]){
                                        $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram,$usuario);
                                        $insumo->cambiarAsignadoInsumo($ram);
                                    }
                                }
                        }
                        // RAM 2
                        if(isset($_POST["idramantigua2"])){
                            if($_POST["idramantigua2"] != $_POST["ram2"]){
                                if($_POST["idramantigua2"] != $_POST["ram"]){
                                    if($_POST["ram2"] != ""){
                                        $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua2"]);
                                        $insumo->cambiarAsignadoInsumo($_POST["ram2"]);

                                        $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua2"]);
                                        $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram2"] );
                                    }else{
                                        $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua2"]);
                                        $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua2"]);
                                        $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                    }
                                    if(isset($data["xD"])){
                                        $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram2"] );
                                    }
                                }

                            }
                        }else if(isset($_POST["ram2"])){
                                if($_POST["ram2"] != ""){
                                    if($_POST["ram2"] != $_POST["ram"]){
                                        $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram2,$usuario);
                                        $insumo->cambiarAsignadoInsumo($ram2);
                                    }
                                }
                        }
// ------------------------------------------------------------------------ALMACENAMIENTO---------------------------------------------------------------------------------
                        if(isset($_POST["idalmacenamientoantiguo"])){
                            if($_POST["idalmacenamientoantiguo"] != $_POST["almacenamiento"]){
                                if($_POST["almacenamiento"] != ""){
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idalmacenamientoantiguo"]);
                                    $insumo->cambiarAsignadoInsumo($_POST["almacenamiento"]);

                                    $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["almacenamiento"] );
                                }else{
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idalmacenamientoantiguo"]);
                                    $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                    $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                }

                            }
                        }else if(isset($_POST["almacenamiento"])){
                                if($_POST["almacenamiento"] != ""){
                                    $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$almacenamiento,$usuario);
                                    $insumo->cambiarAsignadoInsumo($almacenamiento);
                                }
                        }
// ------------------------------------------------------------------------FUENTE DE PODER---------------------------------------------------------------------------------
                        if(isset($_POST["idfuenteantiguo"])){
                            if($_POST["idfuenteantiguo"] != $_POST["fuente"]){
                                if($_POST["fuente"] != ""){
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idfuenteantiguo"]);
                                    $insumo->cambiarAsignadoInsumo($_POST["fuente"]);

                                    $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["fuente"] );
                                }else{
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idfuenteantiguo"]);
                                    $data["xD"] = $insumo->updatearinsumoextrafuente($_POST["serie"]);
                                    $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                }

                            }
                        }else if(isset($_POST["fuente"])){
                                if($_POST["fuente"] != ""){
                                    $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$fuente,$usuario);
                                    $insumo->cambiarAsignadoInsumo($fuente);
                                }
                        }
                break;
// -------------------------------------------------------------------CATEGORIA NOTEBOOK-------------------------------------------------------------------------------------------

                    case $_POST["categoriass"] == 2 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
// ------------------------------------------------------------------------CPU-------------------------------------------------------------------------------------------
                    if(isset($_POST["idcpuantigua"])){
                        if($_POST["idcpuantigua"] != $_POST["procesador"]){
                            if($_POST["procesador"] != ""){
                                $insumo->cambiarAsignadoInsumolibre($_POST["idcpuantigua"]);
                                $insumo->cambiarAsignadoInsumo($_POST["procesador"]);

                                $data["xD"] = $insumo->updatearinsumoextracpu($_POST["serie"]);
                                $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["procesador"] );
                            }else{
                                $insumo->cambiarAsignadoInsumolibre($_POST["idcpuantigua"]);
                                $data["xD"] = $insumo->updatearinsumoextracpu($_POST["serie"]);
                                $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                            }
                        }
                    }else if(isset($_POST["procesador"])){
                            if($_POST["procesador"] != ""){
                                $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$cpu,$usuario);
                                $insumo->cambiarAsignadoInsumo($cpu);
                            }
                    }

// ------------------------------------------------------------------------RAM-------------------------------------------------------------------------------------------
                    if(isset($_POST["idramantigua"])){
                        if($_POST["idramantigua"] != $_POST["ram"]){
                            if($_POST["idramantigua"] != $_POST["ram2"]){
                                if($_POST["ram"] != ""){
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua"]);
                                    $insumo->cambiarAsignadoInsumo($_POST["ram"]);

                                    $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua"]);
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram"] );
                                }else{
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua"]);
                                    $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua"]);

                                    $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                }
                            }
                        }
                    }else if(isset($_POST["ram"])){
                            if($_POST["ram"] != ""){
                                if($_POST["ram"] != $_POST["ram2"]){
                                    $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram,$usuario);
                                    $insumo->cambiarAsignadoInsumo($ram);
                                }
                            }
                    }
                    // RAM 2
                    if(isset($_POST["idramantigua2"])){
                        if($_POST["idramantigua2"] != $_POST["ram2"]){
                            if($_POST["idramantigua2"] != $_POST["ram"]){
                                if($_POST["ram2"] != ""){
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua2"]);
                                    $insumo->cambiarAsignadoInsumo($_POST["ram2"]);

                                    $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua2"]);
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram2"] );
                                }else{
                                    $insumo->cambiarAsignadoInsumolibre($_POST["idramantigua2"]);
                                    $data["xD"] = $insumo->updatearinsumoextraram($_POST["serie"],$_POST["idramantigua2"]);
                                    $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                                }
                                if(isset($data["xD"])){
                                    $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["ram2"] );
                                }
                            }

                        }
                    }else if(isset($_POST["ram2"])){
                            if($_POST["ram2"] != ""){
                                if($_POST["ram2"] != $_POST["ram"]){
                                    $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$ram2,$usuario);
                                    $insumo->cambiarAsignadoInsumo($ram2);
                                }
                            }
                    }

// ------------------------------------------------------------------------ALMACENAMIENTO---------------------------------------------------------------------------------
                    if(isset($_POST["idalmacenamientoantiguo"])){
                        if($_POST["idalmacenamientoantiguo"] != $_POST["almacenamiento"]){
                            if($_POST["almacenamiento"] != ""){
                                $insumo->cambiarAsignadoInsumolibre($_POST["idalmacenamientoantiguo"]);
                                $insumo->cambiarAsignadoInsumo($_POST["almacenamiento"]);

                                $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["almacenamiento"] );
                            }else{
                                $insumo->cambiarAsignadoInsumolibre($_POST["idalmacenamientoantiguo"]);
                                $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                            }

                        }
                    }else if(isset($_POST["almacenamiento"])){
                            if($_POST["almacenamiento"] != ""){
                                $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$almacenamiento,$usuario);
                                $insumo->cambiarAsignadoInsumo($almacenamiento);
                            }
                    }
                  
// ------------------------------------------------------------------------FUENTE DE PODER---------------------------------------------------------------------------------
                    if(isset($_POST["idfuenteantiguo"])){
                        if($_POST["idfuenteantiguo"] != $_POST["fuente"]){
                            if($_POST["fuente"] != ""){
                                $insumo->cambiarAsignadoInsumolibre($_POST["idfuenteantiguo"]);
                                $insumo->cambiarAsignadoInsumo($_POST["fuente"]);

                                $data["xD"] = $insumo->updatearinsumoextraalmacenamiento($_POST["serie"]);
                                $insumo->actualizarextra($data["xD"]["id_insumo"],$_POST["fuente"] );
                            }else{
                                $insumo->cambiarAsignadoInsumolibre($_POST["idfuenteantiguo"]);
                                $data["xD"] = $insumo->updatearinsumoextrafuente($_POST["serie"]);
                                $insumo->deleteinsumoextracpu($data["xD"]["id_insumo"]);
                            }

                        }
                    }else if(isset($_POST["fuente"])){
                            if($_POST["fuente"] != ""){
                                $insumo->insertarInsumo($id,$marca,$modelo,$serie,$descripcion,$asignado,$estado,$id_centro,$id_departamento, $id_box, $id_categoria,$fuente,$usuario);
                                $insumo->cambiarAsignadoInsumo($fuente);
                            }
                    }
                    break;
// -------------------------------------------------------------------CATEGORIA PANTALLA -------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 3 :
                            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                            if(isset($_POST["lista22"])){
                                if(isset($_POST["lista33"])){
                                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                                }
                            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }else if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                    break;
// -------------------------------------------------------------------CATEGORIA MOUSE-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 4:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA TECLADO-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 5:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA CPU-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 6 :
                        $insumo->modificarInsumo($id, $marca, $modelo, $descripcion);
                    break;
// -------------------------------------------------------------------CATEGORIA RAM-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 7:
                        $insumo->modificarInsumo($id, $marca, $modelo, $descripcion);
                    break;
// -------------------------------------------------------------------CATEGORIA ALMACENAMIENTO-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 8:
                        $insumo->modificarInsumo($id, $marca, $modelo, $descripcion);
                    break;
// -------------------------------------------------------------------CATEGORIA SMARTPHONE-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 9:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA HUELLERO -------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 10 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                break;
// -------------------------------------------------------------------CATEGORIA IMPRESORA TERMICA-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 11:
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                break;
// -------------------------------------------------------------------CATEGORIA pendrive-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 12:
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                break;
// -------------------------------------------------------------------CATEGORIA disco duro externo -------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 13 :
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
            break;
// -------------------------------------------------------------------CATEGORIA camara web-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 14:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            break;
// -------------------------------------------------------------------CATEGORIA bam-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 15:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            break;
// -------------------------------------------------------------------CATEGORIA fuente de poder -------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 16 :
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            break;
// -------------------------------------------------------------------CATEGORIA telefono ip-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 17:
            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
            if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            break;
// -------------------------------------------------------------------CATEGORIA switch-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 18:
            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
            if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            break;
// -------------------------------------------------------------------CATEGORIA router -------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 19 :
            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
            if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            break;
// -------------------------------------------------------------------CATEGORIA data show-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 20:
            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
            if(isset($_POST["lista22"])){
            if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }else if(isset($_POST["lista33"])){
            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            break;
// -------------------------------------------------------------------CATEGORIA soplador-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 21:
            $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
            if(isset($_POST["lista22"])){
            if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            }else if($_POST["lista3"] != $_POST["boxantiguo"]){
            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }else if(isset($_POST["lista33"])){
            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
            }
            break;
// -------------------------------------------------------------------CATEGORIA otros-------------------------------------------------------------------------------------------
            case $_POST["categoriass"] == 22:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
                }
        $data["titulo"] = "BOX";
        $this->index();
    }
    public function modificarEncargado($id){
        session_start();
        if(isset($_SESSION['encargado'])){
            $usuario = $_SESSION['encargado']['id_usuario'];
        }

        $insumo = new Insumo_model();
        $centro = new Centro_model();
        $departamento = new Departamento_model();
        $box = new Box_model();
        $mouse = new Insumo_model();
        $pantalla = new Insumo_model();
        $teclado = new Insumo_model();
        $cpu = new Insumo_model();
        $ram = new Insumo_model();
        $rams = new Insumo_model();
        $almacenamiento = new Insumo_model();
        $data["id"] = $id;
        $data["titulo"] = "Editar insumo";
        // obtener informacion del insumo
        $data["insumo"] = $insumo->get_insumo_id($id);
        // obtener los centros de san joaquin
        $data["centro"] = $centro->getIdCentro($usuario);
        $data["departamento"] = $departamento->getDepartamentosPorId($data["insumo"]["id_centro"]);
        $data["box"] = $box->listar_combo_box($data["insumo"]["id_departamento"]);
        $data["extras"] = $insumo->get_insumo_serie($data["insumo"]["num_serie"]);
        $data["rams"] = $rams->get_ram_serie($data["insumo"]["num_serie"]);
        // llamar a la funcion para cargar los componentes del insumo pc o notebook
        if(isset($data["rams"][0])){
            $ididram = $data["rams"][0]["id_extras"];
            $idram = $data["rams"][0]["idcateextra"];
            $marcaram = $data["rams"][0]["marcaextra"];
            $numserieram = $data["rams"][0]["numserieextra"];
        }
        if(isset($data["rams"][1])){
            $ididram2 = $data["rams"][1]["id_extras"];
            $idram2 = $data["rams"][1]["idcateextra"];
            $marcaram2 = $data["rams"][1]["marcaextra"];
            $numserieram2 = $data["rams"][1]["numserieextra"];
        }
        if(isset($data["extras"])){
            foreach($data["extras"] as $dato){
                switch ($dato)
                {
                    case $dato["idcateextra"] == 6 :
                        $idcpu = $dato["idcateextra"];
                        $marcacpu = $dato["marcaextra"];
                        $numseriecpu = $dato["numserieextra"];
                    break;

                    // case $dato["idcateextra"] == 7:
                    //     $idram = $dato["idcateextra"];
                    //     $marcaram = $dato["marcaextra"];
                    //     $numserieram = $dato["numserieextra"];
                    // break;

                    case $dato["idcateextra"] == 8:
                            $idalmacenamiento = $dato["idcateextra"];
                            $marcaalmacenamiento = $dato["marcaextra"];
                            $numseriealmacenamiento = $dato["numserieextra"];

                    break;
                    case $dato["idcateextra"] == 16:
                        $ididfuente = $dato["id_extras"];
                        $idfuente = $dato["idcateextra"];
                        $marcafuente = $dato["marcaextra"];
                        $numseriealfuente = $dato["numserieextra"];

                    break;

                }

            }
        }
         // llamar a las funciones para cargar la informacion de los perifericos en los select de nuevo insumo
         $data["mouse"] = $mouse->get_insumo_mouse();
         $data["pantalla"] = $pantalla->get_insumo_pantalla();
         $data["teclado"] = $teclado->get_insumo_teclado();
         // llamar a las funciones para cargar la informacion de los componentes en los select de nuevo insumo
         $data["cpu"] = $cpu->get_insumo_cpu();
         $data["ram"] = $ram->get_insumo_ram();
         $data["almacenamiento"] = $almacenamiento->get_insumo_almacenamiento();

        require_once 'vista/encargado/insumo_editar_encargado.php';
    }
    public function actualizarEncargado() {
        var_dump($_POST);die();
        session_start();
        if(isset($_SESSION['encargado'])){
            $usuario = $_SESSION['encargado']['id_usuario'];
        }

        $id = $_POST["id"];
        $idd = null;
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        $descripcion = strtoupper($_POST["descripcion"]);
        $id_categoria = $_POST["categoriass"];
        $serie = strtoupper($_POST["serie"]);
        $estado = 0;
        $asignado = 0;

        if(isset($_POST["lista11"])){
            $id_centro = $_POST["lista11"];
        }else{
            if(isset($_POST["lista1"])){
                $id_centro = $_POST["lista1"];
            }
        }
        if(isset($_POST["lista22"])){
            $id_departamento = $_POST["lista22"];
        }else{
            if(isset($_POST["lista2"])){
                $id_departamento = $_POST["lista2"];
            }
        }
        if(isset($_POST["lista33"])){
            $id_box = $_POST["lista33"];
        }else{
            if(isset($_POST["lista3"])){
                $id_box = $_POST["lista3"];
            }
        }
        if(isset($id_departamento)){
            if($id_departamento == 0){?>
                <script>alert("Debes ingresar un departamento.");</script><?php
            }
        }

        if(isset($id_box)){
            if($id_box == 0){?>
                <script>alert("Debes ingresar un box.");</script><?php
            }
        }

        $insumo = new Insumo_model();
        $historial = new Historial_model();
        switch ($_POST["categoriass"])
                {
// -------------------------------------------------------------------CATEGORIA PC ESCRITORIO-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 1 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA NOTEBOOK-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 2 :
                        if(!isset($_POST["lista22"])){
                            if(!isset($_POST["lista33"])){
                                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }else{
                                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA PANTALLA-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 3 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA MOUSE-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 4:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA TECLADO-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 5:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA CPU-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 6 :
                        $insumo->modificarInsumoEncargado($id,$descripcion);
                    break;
// -------------------------------------------------------------------CATEGORIA ram-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 7:
                        $insumo->modificarInsumoEncargado($id, $descripcion);
                    break;
// -----------------------------------------------------------------CATEGORIA ALMACENAMIENTO-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 8:
                        $insumo->modificarInsumoEncargado($id, $descripcion);
                    break;
// -------------------------------------------------------------------CATEGORIA SMARTPHONE-------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 9:
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    break;
// -------------------------------------------------------------------CATEGORIA HUELLERO -------------------------------------------------------------------------------------------
                    case $_POST["categoriass"] == 10 :
                        $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                        if(isset($_POST["lista22"])){
                            if(isset($_POST["lista33"])){
                                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                            }
                        }else if($_POST["lista3"] != $_POST["boxpervio"]){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }else if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                break;
// -------------------------------------------------------------------CATEGORIA IMPRESORA TERMICA-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 11:
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxpervio"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                break;
// -------------------------------------------------------------------CATEGORIA pendrive-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 12:
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                break;
// -------------------------------------------------------------------CATEGORIA disco duro externo -------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 13 :
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                        if(isset($_POST["lista33"])){
                            $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                        }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                break;
// -------------------------------------------------------------------CATEGORIA camara web-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 14:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA bam-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 15:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA fuente de poder -------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 16 :
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                        $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA telefono ip-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 17:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA switch-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 18:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA router -------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 19 :
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA data show-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 20:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA soplador-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 21:
                $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                if(isset($_POST["lista22"])){
                if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }else if(isset($_POST["lista33"])){
                $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                }
                break;
// -------------------------------------------------------------------CATEGORIA otros-------------------------------------------------------------------------------------------
                case $_POST["categoriass"] == 22:
                    $insumo->modificarInsumoPeri($id, $marca, $modelo, $descripcion, $id_centro, $id_departamento, $id_box);
                    if(isset($_POST["lista22"])){
                    if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                    }else if($_POST["lista3"] != $_POST["boxantiguo"]){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }else if(isset($_POST["lista33"])){
                    $historial->insertarHistorial($idd,$usuario, $id, $id_categoria, $id_centro, $id_departamento,$id_box);
                    }
                    break;
                }

        $data["titulo"] = "Dispositivos";
        $this->index1();
    }
    public function eliminar($id){
        $insumo = new Insumo_model();
        $sql = $insumo->darDeBajaInsumo($id);
        $data["titulo"] = "Insumos";
        if($sql == true){
            $this->modificarDadoDeBaja($id);
        }else{
            $this->index();
        }
    }
}
?>