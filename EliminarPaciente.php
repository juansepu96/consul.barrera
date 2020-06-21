<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$paciente=$datos[0];
$password=$datos[1];

$ObtenerPassword=$conexion->query("SELECT * from configuraciones WHERE tipo='password'");

foreach ($ObtenerPassword as $Password){
    $passadmin = $Password['color'];
    break;
}

if($passadmin == $password){
    //Eliminar Paciente
    $EliminarPaciente=$conexion->prepare("DELETE FROM pacientes WHERE ID=:id");
    $EliminarPaciente->bindParam(':id',$paciente);
    $EliminarPaciente->execute();
    //Eliminar Historia Clinica
    $EliminarHC=$conexion->prepare("DELETE FROM hc WHERE ID_paciente=:id");
    $EliminarHC->bindParam(':id',$paciente);
    $EliminarHC->execute();
    //Eliminar Cuenta Corriente
    $EliminarCte=$conexion->prepare("DELETE FROM cte WHERE ID_paciente=:id");
    $EliminarCte->bindParam(':id',$paciente);
    $EliminarCte->execute();
    //Eliminar Laboratorio
    $EliminarLab=$conexion->prepare("DELETE FROM laboratorio WHERE ID_paciente=:id");
    $EliminarLab->bindParam(':id',$paciente);
    $EliminarLab->execute();
    //Eliminar Turnos
    $EliminarTurnos=$conexion->prepare("DELETE FROM turnos WHERE ID_paciente=:id");
    $EliminarTurnos->bindParam(':id',$paciente);
    $EliminarTurnos->execute();

    echo "OK";
}else{
    echo "PASSWRONG";
}

?>