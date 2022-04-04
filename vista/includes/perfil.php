<div class="card">

<div id="divperfil"> 
<i  id="btnperfil" class='bx bxs-user-circle'></i>
</div>
    <?php 
    if(isset( $_SESSION['administrador'])){
      ?>
      <h4>Hola,
        <?php echo $_SESSION['administrador']['correo']?>
      </h4>
    <?php
    }else if(isset($_SESSION['sololectura'])){
      ?>
      <h4>Hola,
        <?php echo $_SESSION['sololectura']['correo']?>
      </h4>
    <?php
    }else if(isset($_SESSION['encargado'])){
      ?>
      <h4>Hola,
        <?php echo $_SESSION['encargado']['correo']?>
      </h4>
    <?php
    }
    ?><div id="divcerrar">
        <p><a id="btncerrarsesionr" href="index.php?c=login&a=logout" >Cerrar Sesion</a>   </p>
      </div>
    

</div> 