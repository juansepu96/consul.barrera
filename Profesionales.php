<?php

require_once "PDO.php";

$ObtenerProfesionales=$conexion->query("SELECT * FROM profesionales ORDER BY nombre");

$hora_inicial="06:00:00";
$segundos_horaInicial=strtotime($hora_inicial);

$tiempo_por_turno=15;
$segundos_minutoAnadir=$tiempo_por_turno*60;

$hora_fin="23:30:00";
$segundos_horafin=strtotime($hora_fin);

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
    <script src="Profesionales.js" ></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Bienvenido! - Profesionales</title>
  </head>
  <body>
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
      <li class="nav-item active">
        <a class="nav-link" href="Profesionales.php">Profesionales</a>
      </li>
      <li class="nav-item">
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
<h2 class="text-center" style="color:white;">Profesionales</h2>

      <div class="row formulario">
        <div class="col-lg-4 col-xl-4 col-md-12 col-xs-12">
          <h2 class=" m-3 p-3 text-center">Lista de Usuarios del Sistema</h2>
          <table class="table table-hover formulario m-3"  style="width:90%">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">NOMBRE</th>
                  <th scope="col">ACTIVO</th>
                  <th scope="col">TIPO</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ObtenerProfesionales as $Profesional) { ?>
                  <tr style="cursor:pointer;" id="<?php echo $Profesional['ID'];?>" onclick="Completar('<?php echo $Profesional['ID'];?>');">
                    <th scope="row"><?php echo $Profesional['ID'];?></th>
                    <td><?php echo $Profesional['nombre'];?></td>
                    <td><?php echo $Profesional['activo'];?></td>
                    <td><?php echo $Profesional['tipo'];?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
         </div>

         <div class="col-lg-8 col-xl-8 col-md-12 col-xs-12 mt-3 ">
         <form id="form-profesional" method="post" action="Profesionales.php" class="m-3 formulario">
            <input hidden type="number" class="form-control" id="id_profesional" name="id_profesional"  placeholder="Ej: Juan">
              <div class="form-row mt-4 ml-5">
                <div class="form-group col-md-5">
                  <label for="username">Usuario</label>
                  <input disabled required  type="text" class="form-control" id="username" name="username"  placeholder="Ej: juansepu96">
                </div>
                <div class="form-group col-md-5">
                  <label for="name">Nombre a mostrar</label>
                  <input disabled required  type="text" class="form-control" id="name" name="name" placeholder="Ej: Dr. Chapatin">
                </div>
              </div>

              <div class="form-row ml-5">
                <div class="form-group col-md-5">
                  <label for="password">Contraseña</label>
                  <input disabled required  type="password" class="form-control" id="password" name="password" placeholder="Ej: Cristina01" >
                </div>
                <div class="form-group col-md-5">
                  <label for="password2">Reingrese contraseña</label>
                  <input disabled required  type="password" class="form-control" id="password2" name="password2" placeholder="Ej: Cristina01" >
                </div>
              </div>

              <div class="form-row ml-5">
                <div class="form-group col-md-5">
                  <label for="tipo">Perfil de Usuario</label>
                  <select disabled name="tipo" id="tipo" class="form-control" onchange="VerificarTipo();">
                      <option selected disabled></option>
                      <option value="PROFESIONAL">PROFESIONAL</option>
                      <option value="USUARIO">USUARIO</option>
                  </select>
                </div>
                <div class="form-group col-md-5">
                  <label for="estado">Activo</label>
                  <select disabled name="estado" id="estado" class="form-control">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                  </select>
                </div>               
              </div>

              <div hidden id="datos_profesionales" class="form-row ml-5">
                <div class="form-group col-md-3">
                  <label for="hora_ini">Hora de Inicio</label>
                  <select disabled name="hora_ini" id="hora_ini" class="form-control">
                  <?php for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
                            $i=$i+$segundos_minutoAnadir;
                            $nuevahora=date("H:i",$i);  ?>
                            <option value="<?php echo $nuevahora;?>"><?php echo $nuevahora;?></option>
                  <?php } ?>
                  </select>
                </div>
                
                <div class="form-group col-md-3">
                  <label for="hora_fin">Hora de Fin</label>
                  <select disabled name="hora_fin" id="hora_fin" class="form-control">
                  <?php for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
                            $i=$i+$segundos_minutoAnadir;
                            $nuevahora=date("H:i",$i);  ?>
                            <option value="<?php echo $nuevahora;?>"><?php echo $nuevahora;?></option>
                  <?php } ?>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label for="tiempo">Tiempo entre turnos</label>
                  <input required type="number" class="form-control" id="tiempo" name="tiempo" placeholder="Ej: 30" >
                </div>

              </div>

              <button type="button" id="nuevo" class="btn btn-primary btn2 ml-5" onclick="NuevoProfesional();">Nuevo</button>
              <button hidden type="submit" name="guardar" id="guardar" class="btn btn-primary btn2" onclick="GuardarProfesional();">Guardar</button>
              <button hidden type="submit" name="actualizar" id="actualizar" class="btn btn-primary btn2 ml-5" onclick="ActualizarProfesional();">Actualizar</button>
              <button hidden type="button" name="cerrarficha" id="cerrarficha" class="btn btn-primary btn2" onclick="CerrarFicha();">Cerrar Ficha</button>

            </form>
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