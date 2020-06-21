<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$description="";
$saldo=0;

if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM cte WHERE (ID_paciente=:valor)");
    $Consulta->bindParam(':valor',$consultaBusqueda);
    $Consulta->execute();
    $filas=$Consulta->rowcount();

    foreach($Consulta as $Date){
        $timestamp = strtotime($Date['fecha']);
        $new_date = date("d/m/Y", $timestamp);
        $importe=(float)$Date['importe'];
     //   $importe=number_format($importe,2);
        $description=$description.$new_date.'@#'.$Date['detalle'].'@#'."$ ".number_format($importe,2).'@#'.$Date['tipo'].'@#';
        if($Date['tipo']=='DEBITO'){
            $saldo=$saldo-$importe;
        }else{
            $saldo=$saldo+$importe;
        }
    }
    $description=$description."$ ".number_format($saldo,2);

}

echo $description;


?>