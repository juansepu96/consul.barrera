<?php

require_once "PDO.php";

$ObtenerUltimoPaciente = $conexion -> query ("SELECT * FROM pacientes ORDER BY ID DESC LIMIT 1");

foreach ($ObtenerUltimoPaciente as $Paciente){
    $id=$Paciente['ID'];
break;
}

echo $id;

?>