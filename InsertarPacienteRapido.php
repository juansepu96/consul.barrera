<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

    $nombre=strtoupper($datos[1]);
    $apellido=strtoupper($datos[0]);
    $dni="0";
    $domicilio="--";
    $fecha_nac="-";
    $celular=$datos[2];
    $ciudad="-";
    $observaciones="---";
    $tel2="-";
    $recomendacion="-";
    $os="-";
    $afiliado="-";
    $email="-";
    $InsertarPaciente=$conexion->prepare("INSERT INTO pacientes (DNI,nombre,apellido,domicilio,fecha_nac,celular,tel2,recomendacion,ciudad,os,afiliado,email,observaciones) VALUES (:dni,:nombre,:apellido,:domicilio,:fecha_nac,:celular,:tel2,:recomendacion,:ciudad,:os,:afiliado,:email,:observaciones)");
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
   if( $InsertarPaciente->execute()){
       echo "OK";
   }else{
       echo "ERROR";
   }




?>