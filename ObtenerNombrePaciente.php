<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$description="";

    $ObtenerNombre=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:id");
	$ObtenerNombre->bindParam(':id',$consultaBusqueda);
	$ObtenerNombre->execute();
	foreach ($ObtenerNombre as $Nombre){
		$name=$Nombre['nombre'];
		$name=$name.' '.$Nombre['apellido'];
	}
    
echo $name;

?>