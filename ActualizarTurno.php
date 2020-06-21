<?php

require_once "PDO.php";

$datos =$_POST['valorBusqueda'];

$datos = explode("@#",$datos);


$ActualizarTurno=$conexion->prepare("UPDATE turnos SET hora_inicio=:hora_inicio,hora_fin=:hora_fin,estado=:estado,observaciones=:observaciones,lapsos=:lapso,laboratorio=:laboratorio WHERE ID=:id");
$ActualizarTurno->bindParam(':id',$datos[0]);
$ActualizarTurno->bindParam(':estado',$datos[3]);
$ActualizarTurno->bindParam(':hora_inicio',$datos[1]);
$ActualizarTurno->bindParam(':hora_fin',$datos[2]);
$ActualizarTurno->bindParam(':observaciones',$datos[4]);
$ActualizarTurno->bindParam(':laboratorio',$datos[7]);

$hora_i=$datos[1].":00";
$segundos_horaInicial=strtotime($hora_i);
$hora_f=$datos[2].":00";
$segundos_horafin=strtotime($hora_f);
$segundos_minutoAnadir=15*60;
$segundos_horafin=$segundos_horafin-$segundos_minutoAnadir;


$lapsos=$datos[1];

for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
    $i=$i+$segundos_minutoAnadir;
    $nuevahora=date("H:i",$i); 
    $lapsos=$lapsos."-".$nuevahora;
}

$ActualizarTurno->bindParam(':lapso',$lapsos);

if($ActualizarTurno->execute()){
    $ObtenerTelefono=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:id");
    $ObtenerTelefono->bindParam(':id',$datos[5]);
    $ObtenerTelefono->execute();
    foreach($ObtenerTelefono as $Telefono){
        $tel=$Telefono['celular'];
    }

    $ObtenerFecha=$conexion->prepare("SELECT * FROM turnos WHERE ID=:id");
    $ObtenerFecha->bindParam(':id',$datos[0]);
    $ObtenerFecha->execute();
    foreach($ObtenerFecha as $Fechaa){
        $Fecha=$Fechaa['fecha'];
    }
    $fecha = strtotime($Fecha);
    $fecha = date("d/m/Y", $fecha);
    $hora =strtotime($datos[1]);
    $hora = date("H:i",$hora);
    $nombre = ObtenerNombrePaciente($conexion,$datos[5]);
    $profesonal = ObtenerNombreProfesional($conexion,$datos[6]);
    $estado = $datos[3];
    
    $mensaje = "Estimado/a ".$nombre." su turno con ".$profesonal." ha sido MODIFICADO. Lugar: Donado 342 el ".$fecha." a las  ".$hora." ESTADO: ".$estado;
    $mensaje2 = "RECORDATORIO : Estimado/a ".$nombre." su turno con ".$profesonal." -  Lugar: Donado 342 el ".$fecha." a las  ".$hora." ESTADO: ".$estado;

    if($estado=="CANCELADO"){
        EnviarMensaje($tel,$mensaje);       
    }

    if($estado=="CONFIRMADO"){
        EnviarMensaje($tel,$mensaje);       
        $nuevafecha = strtotime ( '-1 day' , strtotime ( $datos[1] ) ) ;
        $nuevafecha = date("Y-m-d", $nuevafecha);        
        EnviarMensajeProgramado($tel,$mensaje2,$nuevafecha);   
    }

    echo "OK";

}else{
    echo "OK";
}





?>