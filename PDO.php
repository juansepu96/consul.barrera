<?php

session_start();


if(htmlspecialchars($_SERVER['PHP_SELF']) != "/consultorio/index.php"){
	if(!isset($_SESSION['usuario'])){
		echo '<script>location.href="index.php";</script>';
	}
}


date_default_timezone_set('America/Argentina/Buenos_Aires');

$date=date("Y-m-d");
$time=date("H:i:s");

try {
	$conexion = new PDO('mysql:host=localhost;dbname=consultorio','root','');


}catch(PDOException $e){
		echo "Error" . $e->getMessage();

}

function ObtenerNombrePaciente($conexion,$id_paciente){
	$ObtenerNombre=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:id");
	$ObtenerNombre->bindParam(':id',$id_paciente);
	$ObtenerNombre->execute();
	foreach ($ObtenerNombre as $Nombre){
		$name=$Nombre['nombre'];
		$name=$name.' '.$Nombre['apellido'];
		break;
	}
	return $name;
}

function ObtenerDomicilioPaciente($conexion,$id_paciente){
	$ObtenerDomicilio=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:id");
	$ObtenerDomicilio->bindParam(':id',$id_paciente);
	$ObtenerDomicilio->execute();
	foreach ($ObtenerDomicilio as $Nombre){
		$domicilio=$Nombre['domicilio'];
		break;
	}
	return $domicilio;
}

function ObtenerNombreProfesional($conexion,$id_profesional){
	$ObtenerNombre=$conexion->prepare("SELECT * FROM profesionales WHERE ID=:id");
	$ObtenerNombre->bindParam(':id',$id_profesional);
	$ObtenerNombre->execute();
	foreach ($ObtenerNombre as $Nombre){
		$name=$Nombre['nombre'];
		break;
	}
	return $name;
}

function ObtenerTurnos($conexion,$id_medico,$fecha,$hora){
	$ObtenerTurnos=$conexion->prepare("SELECT * from turnos WHERE ((ID_medico=:id) AND (fecha=:fecha) AND (lapsos LIKE :hora))");
    $ObtenerTurnos->bindParam(':id',$id_medico);
	$ObtenerTurnos->bindParam(':fecha',$fecha);
	$hora="%".$hora."%";
	$ObtenerTurnos->bindParam(':hora',$hora);
	$ObtenerTurnos->execute();
	return $ObtenerTurnos;
}

function EnviarMensaje($telefono,$mensaje){	
	$smsusuario = "SMSDEMO729430"; //usuario de SMS MASIVOS
	$smsclave 	 = "SMSDEMO729430466"; //clave de SMS MASIVOS
	$smsrespuesta = file_get_contents("http://servicio.smsmasivos.com.ar/enviar_sms.asp?API=1&TOS=". urlencode($telefono) ."&TEXTO=". urlencode($mensaje) ."&USUARIO=". urlencode($smsusuario) ."&CLAVE=".urlencode($smsclave));

}

function EnviarMensajeProgramado($telefono,$mensaje,$fecha){	
	$smsusuario = "SMSDEMO729430"; //usuario de SMS MASIVOS
	$smsclave 	 = "SMSDEMO729430466"; //clave de SMS MASIVOS	
	$smsrespuesta = file_get_contents("http://servicio.smsmasivos.com.ar/enviar_sms.asp?API=1&TOS=". urlencode($telefono) ."&TEXTO=". urlencode($mensaje) ."&USUARIO=". urlencode($smsusuario) ."&CLAVE=". urlencode($smsclave)."&FECHADESDE=".urlencode($fecha) );
}


function ObtenerColor($conexion,$estado){
	$ObtenerColor=$conexion->prepare("SELECT * from configuraciones WHERE tipo=:tipo");
	$ObtenerColor->bindParam('tipo',$estado);
	$ObtenerColor->execute();
	foreach ($ObtenerColor as $Color){
		$dato=$Color['color'];
	break;
	}
	return $dato;
}

?>
