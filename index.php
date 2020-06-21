<?php

require_once "PDO.php";

$listadeusuarios=$conexion->query('SELECT * FROM profesionales');	


if (isset($_POST['entrar'])) {
	$usuario = strtolower($_POST['usuario']);
	$password = $_POST['password'];
		foreach ($listadeusuarios as $user) {
			if (( $usuario==$user['user']) && ($password==$user['password'])) {
        if($user['activo']=="SI"){
          $_SESSION['usuario']=$usuario;
          $_SESSION['nombre']=$user['nombre'];
          echo '<script>location.href="Agenda.php";</script>';
          break;	
        }
        else{
         echo '<script> alert("USUARIO NO ESTA ACTIVO. COMUNIQUESE CON EL ADMINISTRADOR.");</script>';
        }
			}
    }
    if (!isset($_SESSION['usuario'])) 
    {
      echo '<script> alert("CREDENCIALES INVÁLIDAS.");</script>';
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    
    <title>Iniciar Sesion!</title>
  </head>
  <body>
    <div class="container">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center mt-4">Inicio de Sesion</h3>            
          </div>
          <div class="card-body">
            <form action="index.php" method="post">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="usuario" class="form-control" placeholder="Usuario:">                
              </div>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Contraseña:">
              </div>
              <div class="form-group">
                <input type="submit" name="entrar" value="Entrar" class="btn float-right login_btn">
              </div>
            </form>
          </div>         
        </div>
      </div>
    </div>   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
  </body>
</html>