<?php

require_once "PDO.php";

$datos="";

$ObtenerConfiguraciones=$conexion->query("SELECT * from configuraciones");
    foreach ($ObtenerConfiguraciones as $Config){
        $datos=$datos."@#".$Config['tipo']."@#".$Config['color']."@#";
    }

echo $datos;

?>