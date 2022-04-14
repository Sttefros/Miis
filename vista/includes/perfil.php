<div class="card">

<div id="divperfil"> 
<i  id="btnperfil" class='bx bxs-user-circle'></i>
</div>
    <?php 
    if(isset( $_SESSION['administrador'])){
      ?>
      <h4>Hola,
      <?=  substr($_SESSION['administrador']['correo'], 0, 20)."...."?>
      </h4>
    <?php
    }else if(isset($_SESSION['sololectura'])){
      ?>
      <h4>Hola,
      <?=  substr($_SESSION['sololectura']['correo'], 0, 20)."...."?>
      </h4>
    <?php
    }else if(isset($_SESSION['encargado'])){
      ?>
      <h4>Hola,
        <?=  substr($_SESSION['encargado']['correo'], 0, 20)."...."?>
      </h4>
    <?php
    }
    ?><div id="divcerrar">
        <p><a id="btncerrarsesionr" href="index.php?c=login&a=logout" >Cerrar Sesion</a>   </p>
      </div>
    

</div> 