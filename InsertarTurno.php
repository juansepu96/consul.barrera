<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$InsertarTurno=$conexion->prepare("INSERT INTO turnos (ID_paciente,fecha,estado,ID_medico,hora_inicio,hora_fin,lapsos,observaciones,laboratorio) VALUES (:ID_paciente,:fecha,:estado,:ID_medico,:hora_inicio,:hora_fin,:lapsos,:observaciones,:laboratorio)");
$InsertarTurno->bindParam(':ID_paciente',$datos[0]);
$InsertarTurno->bindParam(':fecha',$datos[1]);
$InsertarTurno->bindParam(':estado',$datos[2]);
$InsertarTurno->bindParam(':ID_medico',$datos[3]);
$InsertarTurno->bindParam(':hora_inicio',$datos[4]);
$InsertarTurno->bindParam(':hora_fin',$datos[5]);
$InsertarTurno->bindParam(':observaciones',$datos[6]);
$InsertarTurno->bindParam(':laboratorio',$datos[7]);


$hora_i=$datos[4].":00";
$segundos_horaInicial=strtotime($hora_i);
$hora_f=$datos[5].":00";
$segundos_horafin=strtotime($hora_f);

$segundos_minutoAnadir=15*60;

$segundos_horafin=$segundos_horafin-$segundos_minutoAnadir;

$lapsos=$datos[4];

for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
    $i=$i+$segundos_minutoAnadir;
    $nuevahora=date("H:i",$i); 
    $lapsos=$lapsos."-".$nuevahora;
}

$InsertarTurno->bindParam(':lapsos',$lapsos);


if($InsertarTurno->execute()){
    $ObtenerTelefono=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:id");
    $ObtenerTelefono->bindParam(':id',$datos[0]);
    $ObtenerTelefono->execute();
    foreach($ObtenerTelefono as $Telefono){
        $tel=$Telefono['celular'];
    }
    $fecha = strtotime($datos[1]);
    $fecha = date("d/m/Y", $fecha);
    $hora =strtotime($datos[4]);
    $hora = date("H:i",$hora);
    $nombre = ObtenerNombrePaciente($conexion,$datos[0]);
    $profesonal = ObtenerNombreProfesional($conexion,$datos[3]);

    
    $mensaje = "Estimado/a ".$nombre." su turno con ".$profesonal." es en Donado 342 el ".$fecha." a las  ".$hora." / CONFIRMADO";
    $mensaje2 = " RECORDATORIO : Estimado/a ".$nombre." su turno con ".$profesonal." es en Donado 342 el ".$fecha." a las  ".$hora." / CONFIRMADO";

    if($datos[2]=="CONFIRMADO"){
            EnviarMensaje($tel,$mensaje);  
            $nuevafecha = strtotime ( '-1 day' , strtotime ( $datos[1] ) ) ;
            $nuevafecha = date("Y-m-d", $nuevafecha);          
            EnviarMensajeProgramado($tel,$mensaje2,$nuevafecha);        
    }
   
    echo "YES";
}else{
    echo "NO";
}




?>