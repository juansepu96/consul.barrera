<?php

require_once "PDO.php";

?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="Configuraciones.js" ></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Bienvenido! - Configuraciones</title>
  </head>
  <body onload="Update();">
  <nav class="navbar text-center navbar-expand-lg navbar-dark bg-dark navbar-toggleable-sm sticky-top">
        <a class="navbar-brand" href="index.html">
            <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo de Google">
            Consultorio Barrera
         </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav text-center">
      <li class="nav-item">
        <a class="nav-link" href="Agenda.php">Agenda</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="Pacientes.php">Pacientes</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="Profesionales.php">Profesionales</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="Configuraciones.php">Configuraciones</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="Cerrar.php">Cerrar Sesion</a>
      </li> 
           
    </ul>
  </div>
</nav>
<!-- Aca termina el MENU Navegacion -->
<!-- Aca empieza los formularios-->
<section class="container-fluid mt-3 mb-3">
    <h2 class="text-center" style="color:white;">Configuraciones</h2>
      <div class="row formulario">
         <div class="col-lg-8 col-xl-8 col-md-12 col-xs-12 mt-3 ">

              <div class="form-row ml-5 mt-5 formulario mb-5">

              <div class="form-group col-md-5 m-3">
                  <label for="RESERVADO">Turno Reservado</label>
                  <input type="color" name="RESERVADO" id="RESERVADO">
                </div>

                <div class="form-group col-md-5 m-3">
                  <label for="CONFIRMADO">Turno Confirmado</label>
                  <input type="color" name="CONFIRMADO" id="CONFIRMADO">
                </div>                

                <div class="form-group col-md-5 m-3">
                  <label for="ASISTIO">Turno Asistio</label>
                  <input type="color" name="ASISTIO" id="ASISTIO">
                </div>
                
                <div class="form-group col-md-5 m-3">
                  <label for="REPROGRAMADO">Turno Reprogramado</label>
                  <input type="color" name="REPROGRAMADO" id="REPROGRAMADO">
                </div>
                
                <div class="form-group col-md-5 m-3">
                  <label for="NOASISTIO">Turno No Asistio</label>
                  <input type="color" name="NOASISTIO" id="NOASISTIO">
                </div>


                <button type="submit" name="guardar" id="guardar" class="btn btn-primary btn2 ml-4" onclick="ActualizarConfiguraciones();">Guardar</button>

              </div>
         </div>
      
      </div>
</section>
<!-- Aca terminan los formularios-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>    
  </body>
</html>