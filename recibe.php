<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'img/'; // upload directory

        $img = $_FILES['ImagenHC']['name'];
        $tmp = $_FILES['ImagenHC']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = rand(1000,1000000).$img;
        // check's valid format
        if(in_array($ext, $valid_extensions)) { 
            $path = $path.strtolower($final_image); 
            if(move_uploaded_file($tmp,$path))  {
                echo "<img src='$path' />";
                $id_paciente=$_POST['id_paciente_2'];
                $fecha = $_POST['fechaHC'];
                $fechaR = $_POST['fechaRec'];
                $detalle = $_POST['detalleHC'];
                include_once 'PDO.php';
                $insert = $conexion->query("INSERT hc (ID_paciente,fecha,recordatorio,detalle,imagen) VALUES ('".$id_paciente."','".$fecha."','".$fechaR."','".$detalle."','".$path."')");
                echo $insert?'OK':'NO';
            }
         }
