<nav id="navmenu">
        <div id='logo_content'>
            <div id='logo'>
                <img src="./vista/assets/img/LOGO.png" width="200" padding-top="15px">
            </div>
        </div>

       

        <ul>
        <?php if(!isset($_SESSION['encargado'])){?>
            <li>
                <a href="index.php?c=insumo">
                    <i class="bx bxs-devices" ></i>
                    <span class="links_name">Dispositivos</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=historial">
                    <i class='bx bxs-cabinet'></i>
                    <span class="links_name">Historial</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=centro">
                <i class='bx bxs-institution'></i>
                    <span class="links_name">CENTROS</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=departamento">
                    <i class='bx bx-briefcase-alt-2'></i>
                    <span class="links_name">DEPARTAMENTOS</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=box">
                    <i class='bx bx-buildings'></i>
                    <span class="links_name">BOX</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=usuario">
                    <i class='bx bxs-user-detail'></i>
                    <span class="links_name">Usuarios</span>

                </a>
            </li>
            <?php }else{?>
                <li>
                <a href="index.php?c=insumo&a=index1">
                    <i class="bx bxs-devices" ></i>
                    <span class="links_name">Dispositivos</span>

                </a>
            </li>
            <li>
                <a href="index.php?c=historial&a=index1">
                    <i class="bx bxs-devices" ></i>
                    <span class="links_name">Movimientos</span>

                </a>
            </li>
            <?php }?>
            
        </ul>
        <div id="navperfil">
        <?php require_once 'perfil.php';?>
        </div>
        
        
    </nav> 