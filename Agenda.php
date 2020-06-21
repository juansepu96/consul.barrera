<?php

require_once "PDO.php";

if(isset($_POST['actualizar'])){
  $id_paciente=strtoupper($_POST['id_paciente']);
  $nombre=strtoupper($_POST['nombre']);
  $apellido=strtoupper($_POST['apellido']);
  $dni=$_POST['dni'];
  $domicilio=strtoupper($_POST['domicilio']);
  $fecha_nac=$_POST['fecha_nac'];
  $celular=$_POST['celular'];
  $ciudad=strtoupper($_POST['ciudad']);
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
  $ActualizarPaciente=$conexion->prepare("UPDATE pacientes SET nombre=:nombre,apellido=:apellido,dni=:dni,domicilio=:domicilio,fecha_nac=:fecha_nac,celular=:celular,tel2=:tel2,recomendacion=:recomendacion,ciudad=:ciudad,os=:os,afiliado=:afiliado,email=:email,facebook=:facebook,nro_hc=:nro_hc,activo=:activo WHERE ID=:id");
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

$ObtenerProfesionales=$conexion->query("SELECT * from profesionales WHERE ((tipo='PROFESIONAL') AND (activo='SI'))ORDER BY ID ASC");

$fecha=$_POST['fecha'];

$nombreAnterior="";


date_default_timezone_set('America/Argentina/Buenos_Aires');

if(!isset($fecha)){
  $fecha=date("Y-m-d");
}

if(isset($_POST['anterior'])){
  $nuevafecha = strtotime ( '-1 day' , strtotime ( $_POST['fecha'] ) ) ;
  $nuevafecha = date("Y-m-d", $nuevafecha);  
  $fecha=$nuevafecha;
}

if(isset($_POST['siguiente'])){
  $nuevafecha = strtotime ( '+1 day' , strtotime ( $_POST['fecha'] ) ) ;
  $nuevafecha = date("Y-m-d", $nuevafecha);  
  $fecha=$nuevafecha;
}

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return  $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

$fecha_linda = fechaCastellano($fecha);

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="Agenda.js" ></script>
    <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Bienvenido! - Agenda</title>
  </head>
  <body onload="RevisarObservaciones();">
  <div>
  <nav class="navbar text-center navbar-expand-lg navbar-dark bg-dark navbar-toggleable-sm sticky-top">
        <a class="navbar-brand" href="index.html">
            <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo de Google">
            Consultorio Barrera
         </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> <!--Menu de Navegacion-->
    <ul class="navbar-nav text-center">
      <li class="nav-item active">
        <a class="nav-link" href="Agenda.php">Agenda</a>
      </li>
      <li class="nav-item">
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

<section class="container-fluid pt-3 pb-3 sticky-top-2 bg-dark"> <!-- Header -->
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-5 col-xl-5  d-flex">
      <h1 class="text-center" style="color:white;"> Bienvenido, <?php echo $_SESSION['nombre'];?></h1>
    </div>
    <div class="col-xs-12 col-md-12 col-lg-1 col-xl-1">
      <div style="cursor:pointer;" class="mb-1 mt-2">
        <i style="color:white;width:150%;" id="icon_detalles" class="fas fa-file-alt fa-4x"  onclick="AbrirDetalles();"></i>
      </div> 
    </div>
    <div class="col-xs-12 col-md-12 col-lg-5 col-xl-6 ">
      <div>
        <h2 class="text-center" style="color:white"> <?php echo $fecha_linda;?> </h2>
      </div>      
      <form action="Agenda.php" method="post" id="formFecha">
        <div class=" d-flex justify-content-center">
          <button type="submit" class="ml-3 btn btn-primary" name="anterior"><</button>    
          <input type="date" style="height:60%;" class="ml-3 form-control" id="fecha_agenda" name="fecha" onchange="ActualizarAgenda();" value="<?php echo $fecha;?>"> 
          <button type="submit" class="ml-3 btn btn-primary" name="siguiente">></button>      
        </div>  
      </form>     
    </div>
  </div>
</section> 
<!--Termina el menu y empiezan la tabla de turnos-->
<section class="container-fluid mt-3 mb-3 formulario">
<div class="row">
    <?php foreach($ObtenerProfesionales as $Profesional) { 
            $hora_inicial=$Profesional['hora_inicio'];
            $segundos_horaInicial=strtotime($hora_inicial);
          
            
            $tiempo_por_turno=(int)$Profesional['tiempo'];
            $segundos_minutoAnadir=$tiempo_por_turno*60;

            $segundos_horaInicial=$segundos_horaInicial-$segundos_minutoAnadir;
            $hora_inicial=date("H:i",$segundos_horaInicial);
            
            $hora_fin=$Profesional['hora_fin'];
            $segundos_horafin=strtotime($hora_fin);   
            $segundos_horafin=$segundos_horafin-$segundos_minutoAnadir;
      ?>

      <div class="col-lg-4 mt-2 col-12">
        <h4 class="text-center"> <?php echo $Profesional['nombre'];?> </h4>
        <table class="table table-hover tabla-agenda m-2" style="cursor:pointer;">
          <thead>
            <tr>
              <th scope="col" stlye="width:20%" class="celda text-center">Horario</th>
              <th scope="col" style="width: 80%;" class="celda text-center">Paciente</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
                $i=$i+$segundos_minutoAnadir;
                $nuevahora=date("H:i",$i);             
                ?>
                <tr>
                 <th scope="row" class="celda text-center"><?php echo $nuevahora;?></th>
                 <?php $fila_unica=(string)$nuevahora.'@#'.$Profesional['ID'];?>
                 <input hidden type="text" id="<?php echo $fila_unica;?>">
                <?php $turnos = ObtenerTurnos($conexion,$Profesional['ID'],$fecha,$nuevahora);
                    $cantidad=$turnos->RowCount();
                    if($cantidad>0){ 
                        foreach ($turnos as $turno) {    
                          $paciente=$turno['ID_paciente'];
                          $id_turno=$turno['ID'];
                          $nombre = ObtenerNombrePaciente($conexion,$paciente);
                          $color = ObtenerColor($conexion,$turno['estado']);
                          $color = "background: ".$color.";";
                          $dire = ObtenerDomicilioPaciente($conexion,$paciente);
                          $labo=$turno['laboratorio'];
                          if($nombreAnterior!=$nombre){
                            if($labo=="SI"){
                                if($dire=='--'){ ?>
                                  <th scope="row" class='celda text-center' style="color:red; <?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');"><i class="fas fa-thumbtack fa-lg mr-3" style="color:red;transform: rotate(-45deg)"></i>&nbsp;&nbsp;&nbsp;<?php echo $nombre;?></th>               
                                <?php } else { ?>
                                <th scope="row" class='celda text-center' style="<?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');"><i class="fas fa-thumbtack fa-lg mr-3" style="color:red;transform: rotate(-45deg)"></i><?php echo $nombre;?></th>               
                                <?php } 
                            }else{
                                if($dire=='--'){ ?>
                                  <th scope="row" class='celda text-center' style="color:red;<?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');"><?php echo $nombre;?></th>               
                                <?php } else { ?>
                                <th scope="row" class='celda text-center' style="<?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');"><?php echo $nombre;?></th>               
                                <?php } 
                            }                                
                          }else{ 
                            if($dire=='--'){ ?>
                              <th scope="row" class='celda text-center ' style="color:red;<?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');">||</th>               
                            <?php } else { ?>
                             <th scope="row" class='celda text-center ' style="<?php echo $color;?>" onclick="VerTurno('<?php echo $id_turno;?>');">||</th>               
                            <?php } 
                          } 
                          $nombreAnterior=$nombre;
                         
                        }
                    }else { ?>
                        <th scope="row" class="celda text-center" id="celdaVacia" onclick="AbrirNuevoTurno('<?php echo $fila_unica; ?>');"></th>
                     <?php  }  ?>
                </tr>
              <?php } ?>              
          </tbody>
        </table>
      </div>
    <?php } ?>
    

    
</div>

</section>

<!--Aca voy a poner un form flotante para cargar un nuevo Turno-->
<div class="modal" id="NuevoTurno" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Turno</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="CerrarTurno();" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <div id="tabla-ingreso" class="form-row">
                <div class="form-group col-md-9">
                  <input type="text" required class="form-control" id="buscarPaciente" name="buscarPaciente" placeholder="Puede buscar por nombre o DNI">
                </div>
                <div class="form-group col-md-2">
                 <button type="button" name="buscar" id="buscar" class="btn btn-primary" onclick="BuscarPacientes();">Buscar</button>
                </div>
              </div>
              <button type="button" name="nuevoPacienteTurno" id="nuevoPacienteTurno" class="btn btn-primary" onclick="NuevoPacienteTurno();">Nuevo Paciente</button>
              <div hidden id="tabla-bus" class="form-row">
                <h4 class="text-center">Resultado de la Busqueda</h4>
                <table class="table table-hover" id="tabla-busq" style="width:90%">
                  <thead>
                    <tr>
                      <th scope="col">DNI</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Apellido</th>
                    </tr>
                  </thead>
                  <tbody>                    
                  </tbody>
                </table>
              </div>

              <div hidden id="formNuevoPacienteTurno">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="nombrePacientTurno" class="col col-form-label">Nombre</label>
                    <input type="text" required class="form-control" id="nombrePacientTurno" name="nombrePaciente">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="apellidoPacienteTurno" class="col col-form-label">Apellido</label>
                    <input type="text" required class="form-control" id="apellidoPacienteTurno" name="apellidoPacienteTurno">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="celularPacienteTurno" class="col col-form-label">Celular</label>
                    <input type="number" required class="form-control" id="celularPacienteTurno" name="celularPacienteTurno">
                  </div>
                </div>  
                <button type="button" class="btn btn-primary"  onclick="NuevoPacienteRapido();">Guardar Paciente</button>                
              </div>

            <div hidden id="formNuevoTurno2">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input hidden type="text" required class="form-control" id="id_profesional" name="id_profesional">
                  <input hidden type="text" required class="form-control" id="id_paciente" name="id_paciente">
                  <input hidden type="date" required class="form-control" id="fecha_turno" name="fecha_turno" value="<?php echo $fecha;?>">
                  <label for="nombrePaciente" class="col col-form-label">Paciente</label>
                  <input disabled type="text" required class="form-control" id="nombrePaciente" name="nombrePaciente">
                </div>
                <div class="form-group col-md-3">
                 <label for="horaIn" class="col col-form-label">Desde</label>
                 <input readonly type="text" required class="form-control" id="horaIn" name="horaIn">

                </div>
                <div class="form-group col-md-3">
                 <label for="horaFin" class="col col-form-label">Hasta</label>
                 <select required name="horaFin" id="horaFin" class="form-control">
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="estado_turno" class="col col-form-label">Estado</label>
                  <select required name="estado_turno" id="estado_turno" class="form-control">
                          <option value="RESERVADO">RESERVADO</option>
                          <option value="CONFIRMADO">CONFIRMADO</option>
                          <option value="ASISTIO">ASISTIO</option>
                          <option value="REPROGRAMADO">REPROGRAMADO</option>
                          <option value="NO ASISTIO">NO ASISTIO</option>
                  </select>
                </div>  
                <div class="form-group col-md-5">
                 <label for="observaciones" class="col col-form-label">Observaciones</label>
                 <input type="text" class="form-control" id="observacionesTurno" name="observacionesTurno">
                </div> 
                <div class="form-group col-md-3">
                  <label for="laboratorio" class="col col-form-label">Laboratorio</label>
                  <select required name="laboratorio" id="laboratorio" class="form-control">
                          <option value="SI">SI</option>
                          <option selected value="NO">NO</option>
                  </select>
                </div>                  
              </div>
            </div>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="CerrarTurno();">Cerrar</button>
        <button hidden type="button" class="btn btn-primary" id="nuevoturnofinal" onclick="NuevoTurnoFinal();">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Aca voy a poner un form flotante para ver un turno-->
<div class="modal" id="VerTurno" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver Turno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="datosTurno">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input hidden type="text" required class="form-control" id="id_turno" name="id_turno">
                  <input hidden type="text" required class="form-control" id="id_pacienteV" name="id_pacienteV">
                  <input hidden type="text" required class="form-control" id="id_profV" name="id_profV">


                  <label for="nombrePaciente_verT" class="col col-form-label">Paciente</label>
                  <input readonly type="text" required class="form-control" id="nombrePaciente_verT" name="nombrePaciente_verT">
                </div>
                <div class="form-group col-md-3">
                 <label for="horaIn_verT" class="col col-form-label">Desde</label>
                 <select required name="horaIn_verT" id="horaIn_verT" class="form-control" onload="CalcularRangoHasta();" onchange="CalcularRangoHasta();">
                     
                  </select>

                </div>
                <div class="form-group col-md-3">
                 <label for="horaFin_verT" class="col col-form-label">Hasta</label>
                 <select required name="horaFin" id="horaFin_verT" class="form-control">
                         
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="estado_turno_verT" class="col col-form-label">Estado</label>
                  <select required name="estado_turno" id="estado_turno_verT" class="form-control">                          
                          <option value="RESERVADO">RESERVADO</option>
                          <option value="CONFIRMADO">CONFIRMADO</option>
                          <option value="ASISTIO">ASISTIO</option>
                          <option value="REPROGRAMADO">REPROGRAMADO</option>
                          <option value="NO ASISTIO">NO ASISTIO</option>
                  </select>
                </div>  
                <div class="form-group col-md-5">
                 <label for="observaciones_verT" class="col col-form-label">Observaciones</label>
                 <input type="text" class="form-control" id="observaciones_verT" name="observaciones_verT">
              </div>
              <div class="form-group col-md-3">
                  <label for="laboratorio_verT" class="col col-form-label">Laboratorio</label>
                  <select required name="laboratorio_verT" id="laboratorio_verT" class="form-control">
                          <option value="SI">SI</option>
                          <option selected value="NO">NO</option>
                  </select>
                </div>                   
              </div>
            </div>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary mr-5"  onclick="IrAFicha();">Ir a Ficha</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="CerrarVista();">Cerrar</button>
        <button type="button" class="btn btn-primary" style="background:red;" onclick="BorrarTurno();">Borrar</button>
        <button type="button" class="btn btn-primary" id="actualizarTurno" onclick="ActualizarTurno();">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!--Aca voy a poner un form flotante para ver detalles del dia-->
<div class="modal" id="VerDetalles" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver observaciones del día <?php echo date("d/m/Y",strtotime($fecha));?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <textarea id="detallesDelDia" class="form-control"></textarea>              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardarDetalles" onclick="GuardarDetalles();">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Aca voy a poner un form flotante para ver Ficha del paciente-->
<div class="modal" id="VerFichaPaciente" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver Ficha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body formulario">
      <form id="form-paciente" method="post" action="Agenda.php">
            <input hidden type="number" class="form-control" id="id_paciente2" name="id_paciente"  placeholder="Ej: Juan">

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
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button hidden type="submit" name="actualizar" id="actualizar" class="btn btn-primary btn2">Actualizar</button>
      </div>

    </div>
  </div>
        </form>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
    <script>
      $('#fecha_agenda').datepicker({
     onSelect: function(d,i){
          if(d !== i.lastVal){
              $(this).change();
          }
     }
    });
    </script>
  </div>
  </body>
</html>