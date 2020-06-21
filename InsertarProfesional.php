<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$InsertarProfesional=$conexion->prepare("INSERT INTO profesionales (nombre,user,password,tipo,activo,tiempo,hora_inicio,hora_fin) VALUES (:nombre,:user,:password,:tipo,:activo,:tiempo,:hora_inicio,:hora_fin)");
$InsertarProfesional->bindParam(':nombre',$datos[1]);
$InsertarProfesional->bindParam(':user',$datos[0]);
$InsertarProfesional->bindParam(':password',$datos[2]);
$InsertarProfesional->bindParam(':tipo',$datos[3]);
if($datos[3]=="USUARIO"){
    $datos[5]="00:00:00";
    $datos[6]="00:00:00";
    $datos[7]="0";
}else{
    $datos[5]=$datos[5].":00";
    $datos[6]=$datos[6].":00";
}
$InsertarProfesional->bindParam(':activo',$datos[4]);
$InsertarProfesional->bindParam(':tiempo',$datos[7]);
$InsertarProfesional->bindParam(':hora_inicio',$datos[5]);
$InsertarProfesional->bindParam(':hora_fin',$datos[6]);
if($InsertarProfesional->execute()){
    echo "YES";
}else{
    echo "NO";
}




?>