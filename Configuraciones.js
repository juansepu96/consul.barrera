function ActualizarConfiguraciones(){
    reprogramado = $('#REPROGRAMADO').val();
    datos = "REPROGRAMADO@#"+reprogramado;
    $.post("ActualizarConfiguracion.php",{valorBusqueda:datos}, function(hc) {  });

    reservado = $('#RESERVADO').val();
    datos="RESERVADO@#"+reservado;
    $.post("ActualizarConfiguracion.php",{valorBusqueda:datos}, function(hc) {  });

    asistio = $('#ASISTIO').val();
    datos="ASISTIO@#"+asistio;
    $.post("ActualizarConfiguracion.php",{valorBusqueda:datos}, function(hc) {  });

    confirmado = $('#CONFIRMADO').val();
    datos="CONFIRMADO@#"+confirmado;
    $.post("ActualizarConfiguracion.php",{valorBusqueda:datos}, function(hc) {  });

    noasistio = $('#NOASISTIO').val();
    datos="NO ASISTIO@#"+noasistio;
    $.post("ActualizarConfiguracion.php",{valorBusqueda:datos}, function(hc) {  });

    alert("Configuracion actualizada!");
    location.reload();
}

function Update(){
    datos="";
    $.post("ObtenerConfiguraciones.php",{valorBusqueda:datos}, function(hc) { 
        
        hc = hc.split('@#');

            var i ;
           cantidad = hc.length-1;

            for (i=1;i<cantidad;i+=3){
                elemento = hc[i];

                if(elemento == "NO ASISTIO"){
                    elemento = "#NOASISTIO";
                    valor = hc[i+1];
                    $(elemento).val(valor);
                }else{
                    elemento = "#"+hc[i];
                    valor = hc[i+1];
                    $(elemento).val(valor);
                };
            }
       
     });
    }