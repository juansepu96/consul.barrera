<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$ActualizarProfesional=$conexion->prepare("UPDATE profesionales SET nombre=:nombre,user=:user,password=:password,tipo=:tipo,activo=:activo,tiempo=:tiempo,hora_inicio=:hora_inicio,hora_fin=:hora_fin WHERE ID=:id");
$ActualizarProfesional->bindParam(':id',$datos[8]);
$ActualizarProfesional->bindParam(':nombre',$datos[1]);
$ActualizarProfesional->bindParam(':user',$datos[0]);
$ActualizarProfesional->bindParam(':password',$datos[2]);
$ActualizarProfesional->bindParam(':tipo',$datos[3]);
if($datos[3]=="USUARIO"){
    $datos[5]="00:00:00";
    $datos[6]="00:00:00";
    $datos[7]="0";
}else{
    $datos[5]=$datos[5].":00";
    $datos[6]=$datos[6].":00";
}
$ActualizarProfesional->bindParam(':activo',$datos[4]);
$ActualizarProfesional->bindParam(':tiempo',$datos[7]);
$ActualizarProfesional->bindParam(':hora_inicio',$datos[5]);
$ActualizarProfesional->bindParam(':hora_fin',$datos[6]);
if($ActualizarProfesional->execute()){
    echo "YES";
}else{
    echo "NO";
}




?>