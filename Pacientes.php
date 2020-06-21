<?php

require_once "PDO.php";

if(isset($_POST['guardar'])){
  $nombre=strtoupper($_POST['nombre']);
  $apellido=strtoupper($_POST['apellido']);
  $dni=$_POST['dni'];
  $domicilio=strtoupper($_POST['domicilio']);
  $fecha_nac=$_POST['fecha_nac'];
  $celular=$_POST['celular'];
  $ciudad=strtoupper($_POST['ciudad']);
  $observaciones="---";

  if(!isset($_POST['tel2'])){
    $tel2='00000000';
  }else{
    $tel2=$_POST['tel2'];
  }

  if(!isset($_POST['recomendacion'])){
    $recomendacion='---';
  }else{
    $recomendacion=strtoupper($_POST['recomendacion']);
  }

  if(!isset($_POST['os'])){
    $os='---';
  }else{
    $os=strtoupper($_POST['os']);
  }
  if(!isset($_POST['afiliado'])){
    $afiliado='---';
  }else{
    $afiliado=strtoupper($_POST['afiliado']);
  }

  if(!isset($_POST['email'])){
    $email='---';
  }else{
    $email=strtoupper($_POST['email']);
  }
   if(!isset($_POST['facebook'])){
    $facebook='---';
  }else{
    $facebook=strtoupper($_POST['facebook']);
  }
  if(!isset($_POST['nro_hc'])){
    $nro_hc='-1';
  }else{
    $nro_hc=$_POST['nro_hc'];
  }

  $activo=$_POST['activo'];
  
    $InsertarPaciente=$conexion->prepare("INSERT INTO pacientes (DNI,nombre,apellido,domicilio,fecha_nac,celular,tel2,recomendacion,ciudad,os,afiliado,email,observaciones,facebook,nro_hc,activo) VALUES (:dni,:nombre,:apellido,:domicilio,:fecha_nac,:celular,:tel2,:recomendacion,:ciudad,:os,:afiliado,:email,:observaciones,:facebook,:nro_hc,:activo)");
    $InsertarPaciente->bindParam(':dni',$dni);
    $InsertarPaciente->bindParam(':nombre',$nombre);
    $InsertarPaciente->bindParam(':apellido',$apellido);
    $InsertarPaciente->bindParam(':domicilio',$domicilio);
    $InsertarPaciente->bindParam(':fecha_nac',$fecha_nac);
    $InsertarPaciente->bindParam(':celular',$celular);
    $InsertarPaciente->bindParam(':tel2',$tel2);
    $InsertarPaciente->bindParam(':recomendacion',$recomendacion);
    $InsertarPaciente->bindParam(':ciudad',$ciudad);
    $InsertarPaciente->bindParam(':os',$os);
    $InsertarPaciente->bindParam(':afiliado',$afiliado);
    $InsertarPaciente->bindParam(':email',$email);
    $InsertarPaciente->bindParam(':observaciones',$observaciones);
    $InsertarPaciente->bindParam(':facebook',$facebook);
    $InsertarPaciente->bindParam(':nro_hc',$nro_hc);
    $InsertarPaciente->bindParam(':activo',$activo);
    if($InsertarPaciente->execute()){
      echo '<script>alert("Paciente cargado con éxito!!");</script>';
    }else{
      echo '<script>alert("Error al guardar paciente. Consulte con el Administrador.");</script>';
      echo "\nPDO::errorInfo():\n";
      print_r($InsertarPaciente->errorInfo());

    }

}

if(isset($_POST['actualizar'])){
    $id_paciente=strtoupper($_POST['id_paciente']);
    $nombre=strtoupper($_POST['nombre']);
    $apellido=strtoupper($_POST['apellido']);
    $dni=$_POST['dni'];
    $domicilio=strtoupper($_POST['domicilio']);
    $fecha_nac=$_POST['fecha_nac'];
    $celular=$_POST['celular'];
    $ciudad=strtoupper($_POST['ciudad']);
    $observaciones=strtoupper($_POST['observaciones_1']);
    if(!isset($_POST['facebook'])){
      $facebook='---';
    }else{
      $facebook=strtoupper($_POST['facebook']);
    }
    if(!isset($_POST['tel2'])){
      $tel2='00000000';
    }else{
      $tel2=$_POST['tel2'];
    }

    if(!isset($_POST['recomendacion'])){
      $recomendacion='---';
    }else{
      $recomendacion=strtoupper($_POST['recomendacion']);
    }

    if(!isset($_POST['os'])){
      $os='---';
    }else{
      $os=strtoupper($_POST['os']);
    }

    if(!isset($_POST['afiliado'])){
      $afiliado='---';
    }else{
      $afiliado=strtoupper($_POST['afiliado']);
    }

    if(!isset($_POST['email'])){
      $email='---';
    }else{
      $email=strtoupper($_POST['email']);
    }
    if(!isset($_POST['nro_hc'])){
      $nro_hc='-1';
    }else{
      $nro_hc=$_POST['nro_hc'];
    }
    $activo=$_POST['activo'];
    $ActualizarPaciente=$conexion->prepare("UPDATE pacientes SET nombre=:nombre,apellido=:apellido,dni=:dni,domicilio=:domicilio,fecha_nac=:fecha_nac,celular=:celular,tel2=:tel2,recomendacion=:recomendacion,ciudad=:ciudad,os=:os,afiliado=:afiliado,email=:email,observaciones=:observaciones,facebook=:facebook,nro_hc=:nro_hc,activo=:activo WHERE ID=:id");
    $ActualizarPaciente->bindParam(':id',$id_paciente);
    $ActualizarPaciente->bindParam(':dni',$dni);
    $ActualizarPaciente->bindParam(':nombre',$nombre);
    $ActualizarPaciente->bindParam(':apellido',$apellido);
    $ActualizarPaciente->bindParam(':domicilio',$domicilio);
    $ActualizarPaciente->bindParam(':fecha_nac',$fecha_nac);
    $ActualizarPaciente->bindParam(':celular',$celular);
    $ActualizarPaciente->bindParam(':tel2',$tel2);
    $ActualizarPaciente->bindParam(':recomendacion',$recomendacion);
    $ActualizarPaciente->bindParam(':ciudad',$ciudad);
    $ActualizarPaciente->bindParam(':os',$os);
    $ActualizarPaciente->bindParam(':afiliado',$afiliado);
    $ActualizarPaciente->bindParam(':email',$email);
    $ActualizarPaciente->bindParam(':observaciones',$observaciones);
    $ActualizarPaciente->bindParam(':facebook',$facebook);
    $ActualizarPaciente->bindParam(':nro_hc',$nro_hc);
    $ActualizarPaciente->bindParam(':activo',$activo);
    if($ActualizarPaciente->execute()){
    echo '<script>alert("Paciente actualizado con éxito!!");</script>';
  }else{
    echo '<script>alert("Error al actualizar paciente. Consulte con el Administrador.");</script>';
    echo "\nPDO::errorInfo():\n";
    print_r($ActualizarPaciente->errorInfo());

  }

}

$ObtenerPaciente=$conexion->query("SELECT * FROM pacientes ORDER BY apellido,nombre ASC LIMIT 5");

if(isset($_POST['buscar'])){
  $nombre=$_POST['busqueda_nombre'];
  $nombre='%'.$nombre.'%';
  $dni=$_POST['busqueda_dni'];
  $dni="%".$dni."%";
  $ObtenerPaciente=$conexion->prepare("SELECT * FROM pacientes WHERE ((nombre LIKE :nombre) AND (dni LIKE :dni) OR (apellido LIKE :apellido))");
  $ObtenerPaciente->bindParam(':nombre',$nombre);
  $ObtenerPaciente->bindParam(':apellido',$nombre);
  $ObtenerPaciente->bindParam('dni',$dni);
  $ObtenerPaciente->execute();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="Pacientes.js" ></script>
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Bienvenido! - Pacientes</title>
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
      <li class="nav-item active">
        <a class="nav-link" href="Pacientes.php">Pacientes</a>
      </li>
      <li class="nav-item">
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
<h2 class="text-center" style="color:white;">Pacientes</h2>
        <div class="row col-md-12 m-0">
          <div class="col-12 col-md-12 col-sm-12 formulario col-lg-4 col-xl-4"> <!--Formulario de busqueda-->
            <div class="row d-flex justify-content-center m-4 pt-4 p-4 formulario">
            <form method="post">
                <h4 class="text-center">Buscar un Paciente</h4>
              <div class="form-group row pt-4">
                <label for="Nombre" class="col col-form-label">Nombre</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="busqueda_nombre" id="busqueda_nombre" placeholder="Nombre:" onclick="DesactivarDNI();">
                </div>
              </div>
              <div class="form-group row">
                <label for="DNI" class="col col-form-label">DNI</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="busqueda_dni" id="busqueda_dni" placeholder="DNI:" onclick="DesactivarNombre();">
                </div>
              </div>              
              <div class="form-group row">
                <div class="col-sm-10 d-flex justify-content-end">
                  <button type="submit" name="buscar" class="btn btn-primary d-flex" >Buscar</button>
                </div>
              </div>
            </form>
            </div>
            <div class="row d-flex justify-content-center formulario m-4 p-3" style="cursor:pointer; width:90%;"> <!-- Tabla con los resultados -->
            <h4 class="text-center">Resultado de la Busqueda</h4>
            <table class="table table-hover" style="width:90%">
              <thead>
                <tr>
                  <th scope="col">DNI</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ObtenerPaciente as $Paciente) { ?>
                  <tr style="cursor:pointer;" id="<?php echo $Paciente['ID'];?>" onclick="Completar(<?php echo $Paciente['ID'];?>);">
                    <th scope="row"><?php echo $Paciente['DNI'];?></th>
                    <td><?php echo $Paciente['nombre'];?></td>
                    <td><?php echo $Paciente['apellido'];?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="col-12 col-md-12 col-sm-12 formulario col-lg-8 col-xl-8">
          <div class="row d-flex justify-content-center p-3 formulario mt-2 mb-2"> <!--Formulario de datos del paciente o carga de uno nuevo-->
            <form id="form-paciente" method="post" action="Pacientes.php">
            <input hidden type="number" class="form-control" id="id_paciente" name="id_paciente"  placeholder="Ej: Juan">

              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="Nombre">Nombre</label>
                  <input disabled required  type="text" class="form-control" id="nombre" name="nombre"  data-toggle="tooltip" data-placement="bottom" title="Ej. Juan">
                </div>
                <div class="form-group col-md-4">
                  <label for="apellido">Apellido</label>
                  <input disabled required  type="text" class="form-control" id="apellido" name="apellido" data-toggle="tooltip" data-placement="bottom" title="Gonzalez">
                </div>
                <div class="form-group col-md-3">
                  <label for="dni">DNI</label>
                  <input disabled required  type="number" class="form-control" id="dni" name="dni" data-toggle="tooltip" data-placement="bottom" title="Sin puntos ni coma">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="domicilio">Domicilio</label>
                  <input disabled required  type="text" class="form-control" id="domicilio" name="domicilio" data-toggle="tooltip" data-placement="bottom" title="Av. Siempreviva 742">
                </div>
                <div class="form-group col-md-4">
                  <label for="fecha_nac">Fecha de Nacimiento</label>
                  <input disabled required  type="date" class="form-control" id="fecha_nac" name="fecha_nac">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="celular">Celular</label>
                  <input disabled required  type="number" class="form-control" id="celular"  name="celular" data-toggle="tooltip" data-placement="bottom" title="Sin 0 ni 15">
                </div>
                <div class="form-group col-md-4">
                  <label for="tel2">Telefono Alternativo</label>
                  <input disabled  type="number" class="form-control" id="tel2" name="tel2" data-toggle="tooltip" data-placement="bottom" title="Sin 0 ni 15">
                </div>
                <div class="form-group col-md-4">
                  <label for="recomendacion">Recomendacion</label>
                  <input disabled type="text" class="form-control" id="recomendacion" name="recomendacion" data-toggle="tooltip" data-placement="bottom" title="Ej. Dr. Chuchugua">
                </div>
              </div>              
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="ciudad">Ciudad</label>
                  <input disabled required  type="text" class="form-control" id="ciudad" name="ciudad" data-toggle="tooltip" data-placement="bottom" title="Ej: New York">
                </div>
                <div class="form-group col-md-2">
                  <label for="os">Obra Social</label>
                  <input disabled  type="text" class="form-control" id="os" name="os" data-toggle="tooltip" data-placement="bottom" title="Ej: OSDE">
                </div>
                <div class="form-group col-md-3">
                  <label for="afiliado">Nro. Afiliado</label>
                  <input disabled type="text" class="form-control" id="afiliado" name="afiliado" data-toggle="tooltip" data-placement="bottom" title="Ej: 12345/6J1">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">E-Mail</label>
                  <input disabled type="email" class="form-control" id="email" name="email" data-toggle="tooltip" data-placement="bottom" title="Ej: cris@tina.com">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="facebook">Facebook</label>
                  <input disabled  type="text" class="form-control" id="facebook" name="facebook" data-toggle="tooltip" data-placement="bottom" title="Indicar tal cual aparece">
                </div> 
                <div class="form-group col-md-2">
                  <label for="nro_hc">Nro. HC</label>
                  <input disabled type="text" class="form-control" id="nro_hc" name="nro_hc" data-toggle="tooltip" data-placement="bottom" title="En caso de corresponder H.C archivada">
                </div> 
                <div class="form-group col-md-2">
                  <label for="activo">Activo</label>
                  <select disabled name="activo" id="activo" class="form-control">
                    <option selected value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>                
              </div>
              <ul hidden id="menu-2" class="nav nav-tabs" style="cursor:pointer;">
                <li  class="nav-item">
                  <a class="nav-link item2" href="#HC">Hist. Clínica</a>                  
                </li>
                <li class="nav-item">
                  <a class="nav-link item2" href="#observaciones">Observ.</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link item2" href="#Asistencias">Asistencias</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link item2" href="#Inasistencias">Inasistencias</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link item2" href="#CuentaCte">Cuenta Cte.</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link item2" href="#Laboratorio">Laboratorio</a>
                </li>
             </ul>
             <!-- Paneles de pestañas ocultos -->             
            <div class="tab-content border mb-3">   
             <div id="HC" class="container tab-pane fade"><br>
             <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#NuevoHC">Nuevo Registro</button>  <br>
              <table class="table table-hover" id="tabla-hc" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Recordatorio</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Imagen</th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
                </table>
             </div>        
              <div id="observaciones" class="container tab-pane fade"><br>
                  <textarea class="form-control" style="margin:15px" name="observaciones_1" id="observaciones_1"></textarea>
              </div>
              <div id="Asistencias" class="container tab-pane fade"><br>
                <table class="table table-hover" id="tabla-asistencias" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Estado</th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
                </table>
              </div>
              <div id="Inasistencias" class="container tab-pane fade"><br>
                  <table class="table table-hover" id="tabla-inasistencias" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Estado</th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
                </table>
              </div>
              <div id="CuentaCte" class="container tab-pane fade"><br>
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#NuevoCte">Nuevo Movimiento</button>  <br>
                 <table class="table table-hover" id="tabla-cte" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Importe</th>
                      <th scope="col">Tipo Mov.</th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
                </table>
              </div>
              <div id="Laboratorio" class="container tab-pane fade"><br>
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#NuevoLaboratorio">Nuevo Laboratorio</button>  <br>
                 <table class="table table-hover" id="tabla-laboratorio" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Importe</th>
                      <th scope="col">Tipo Mov</th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
                </table>
              </div>
            </div>
              <button type="button" id="nuevo" class="btn btn-primary btn2" onclick="NuevoPaciente();">Nuevo</button>
              <button hidden type="button" name="editar" id="editar" class="btn btn-primary btn2">Editar</button>
              <button hidden type="submit" name="guardar" id="guardar" class="btn btn-primary btn2">Guardar</button>
              <button hidden type="submit" name="actualizar" id="actualizar" class="btn btn-primary btn2">Actualizar</button>
              <button hidden type="button" name="borrar" id="borrar" class="btn btn-primary btn2" style="background:red;" onclick="BorrarPaciente();">Borrar</button>
              <button hidden type="button" name="descartar" id="descartar" class="btn btn-primary btn2" onclick="DescartarCarga();">Descartar</button>
              <button hidden type="button" name="cerrarficha" id="cerrarficha" class="btn btn-primary btn2" onclick="CerrarFicha();">Cerrar Ficha</button>

            </form>
            </div>

          </div> 
        </div>
</section>
<!-- Aca terminan los formularios-->
<!--Aca voy a poner un form flotante para cargar un nuevo novimiento en HC-->
<div class="modal" id="NuevoHC" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Movimiento de HC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="formNuevoHC">
                  <input hidden type="number" class="form-control" id="id_paciente_2" name="id_paciente_2"  placeholder="Ej: Juan">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="fechaHC">Fecha</label>
                      <input required  type="date" class="form-control" id="fechaHC" name="fechaHC" value="<?php echo date("Y-m-d");?>">
                    </div>
                    <div class="form-group col-md-6">
                       <label for="fechaRec">Fecha Recordatorio</label>
                      <input required  type="date" class="form-control" id="fechaRec" name="fechaRec" value="<?php echo date("Y-m-d");?>">
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-12">
                      <label for="detalleHC">Detalle</label>
                      <textarea required class="form-control" id="detalleHC" name="detalleHC" placeholder="Ej: Tratamiento de Conducto..."></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-12">
                      <label for="ImagenHC">Imagen</label>
                      <input type="file" required class="form-control" id="ImagenHC" name="ImagenHC" placeholder="Ej: Tratamiento de Conducto...">
                    </div>
                  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="NuevoMovimientoHC();">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!--Aca finaliza el nuevo movimiento en HC e ingreso nuevo movimiento de Cte-->
<div class="modal" id="NuevoCte" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Movimiento Cuenta Corriente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="fechaMov">Fecha</label>
                      <input required  type="date" class="form-control" id="fechaMov" name="fechaMov" value="<?php echo date("Y-m-d");?>">
                    </div>
                    <div class="form-group col-md-6">
                       <label for="tipoMov">Tipo de Movimiento</label>
                       <select required name="tipoMov" id="tipoMov" class="form-control">
                        <option value="DEBITO">DEBITO (Plata que debe)</option>
                        <option value="CREDITO">CREDITO (Plata que me pagó)</option>
                       </select>
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="importeMov">Importe</label>
                      <input required  type="number" autocomplete="off" step="0.01" class="form-control" id="importeMov" name="importeMov" value="0.00">
                    </div>
                    <div class="form-group col-md-8">
                       <label for="detalleMov">Detalle</label>
                       <input required  type="text" class="form-control" id="detalleMov" name="detalleMov" value="...">
                     </div>
                  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="NuevoMovimientoCte();">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!--Aca finaliza el nuevo movimiento en Cte e ingreso nuevo movimiento de Laboratorio-->
<div class="modal" id="NuevoLaboratorio" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Movimiento de Laboratorio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="fechaLab">Fecha</label>
                      <input required  type="date" class="form-control" id="fechaLab" name="fechaLab" value="<?php echo date("Y-m-d");?>">
                    </div>
                    <div class="form-group col-md-6">
                       <label for="tipoLab">Tipo de Movimiento</label>
                       <select required name="tipoLab" id="tipoLab" class="form-control">
                        <option value="DEBITO">DEBITO (Plata que debe)</option>
                        <option value="CREDITO">CREDITO (Plata que me pagó)</option>
                       </select>
                     </div>
                  </div>
                  <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="importeLab">Importe</label>
                      <input required  type="number" autocomplete="off" step="0.01" class="form-control" id="importeLab" name="importeLab" value="0.00">
                    </div>
                    <div class="form-group col-md-8">
                       <label for="detalleLab">Detalle</label>
                       <input required  type="text" class="form-control" id="detalleLab" name="detalleLab" value="...">
                     </div>
                  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="NuevoMovimientoLaboratorio();">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Aca finaliza el nuevo movimiento en Lab e inicio la vista de img-->
<div class="modal" id="MostrarImagen" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver Imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="ImagenHC_1" height="400px" width="100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Aca finaliza  la vista de img y pido clave al borrar-->
<div class="modal" id="BorrarPaciente" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese contraseña de Supervisor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input hidden type="text" id="paciente_borrar" name="paciente_borrar" class="form-control">
          <div class="alert alert-danger" role="alert">
              RECUERDE QUE ESTA ELIMINANDO UN PACIENTE Y TODOS LOS DATOS ASOCIADOS.  <hr>
              SE ELIMINARAN TODOS LOS TURNOS ASOCIADOS, HISTORIAL DE H.C, LABORATORIOS, FICHA COMPLETA Y CUENTA CORRIENTE.<hr>
              ESTA ACCION ES IRREVERSIBLE! 
          </div>
          <label for="password">Ingrese la contraseña</label>
          <input type="password" id="password" name="password" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" style="background:red;" onclick="BorrarPaciente2();">BORRAR</button>

      </div>
    </div>
  </div>
</div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
    <script>
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

      $(document).ready(function(){
      $(".nav-tabs a").click(function(){
        $(this).tab('show');
      });
      });
    </script>

    
  </body>
</html>