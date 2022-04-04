<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="index.php?c=login&a=login" method="post">
                <span class="login-form-title">LOGIN</span>
                

                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" id="correo" name="correo" required autocomplete="off" placeholder="Correo">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" required placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>
                <!-- validacion si existe la sesion error login  -->
                <?php if(isset($_SESSION['error_login'])): ?>
                        <div class="alerta-registrar" >
				            <?=$_SESSION['error_login'];?>
			            </div>
		        <?php endif; ?>
                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">CONECTAR</button>
                    </div>
                </div>
            </form>
        </div>
</body>
</html>