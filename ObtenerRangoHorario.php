<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];


$datos = explode("@#",$consultaBusqueda);

$lapsos="";


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM profesionales WHERE (ID=:id)");
    $Consulta->bindParam(':id',$datos[0]);
    $Consulta->execute();
    foreach($Consulta as $Date){
        $hora_f=$Date['hora_fin'];
        $segundos_horafin=strtotime($hora_f);
        $segundos_minutoAnadir=$Date['tiempo']*60;
        $hora_i=$datos[1].":00";    
        $segundos_horaInicial=strtotime($hora_i);        
        if($segundos_horaInicial==false){
            $hora_i=$Date['hora_inicio'];
            $segundos_horaInicial=strtotime($hora_i);
        }
        $segundos_horaInicial=$segundos_horaInicial-$segundos_minutoAnadir;
            
            for ($i=$segundos_horaInicial;$i<$segundos_horafin;){   
                $i=$i+$segundos_minutoAnadir;
                $nuevahora=date("H:i",$i); 
                $lapsos=$lapsos."@#".$nuevahora;
            }
    }

}

echo $lapsos;


?>