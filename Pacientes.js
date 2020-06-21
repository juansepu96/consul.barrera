function NuevoPaciente() { 
    $( "#nombre" ).prop( "disabled", false );
    $("#apellido").prop('disabled', false);
    $("#dni").prop('disabled', false);
    $("#domicilio").prop('disabled', false);
    $("#fecha_nac").prop('disabled', false);
    $("#celular").prop('disabled', false);
    $("#tel2").prop('disabled', false);
    $("#recomendacion").prop('disabled', false);
    $("#ciudad").prop('disabled', false);
    $("#os").prop('disabled', false);
    $("#facebook").prop('disabled', false);
    $("#nro_hc").prop('disabled', false);
    $("#activo").prop('disabled', false);
    $("#afiliado").prop('disabled', false);
    $("#email").prop('disabled', false);
    $("#guardar").prop('hidden', false);
    $("#descartar").prop('hidden', false);
    $("#nuevo").prop('hidden', true);
}

function DescartarCarga() { 
    $( "#nombre" ).prop( "disabled", true );
    $("#apellido").prop('disabled', true);
    $("#dni").prop('disabled', true);
    $("#domicilio").prop('disabled', true);
    $("#fecha_nac").prop('disabled', true);
    $("#celular").prop('disabled', true);
    $("#facebook").prop('disabled', true);
    $("#nro_hc").prop('disabled', true);
    $("#activo").prop('disabled', true);
    $("#tel2").prop('disabled', true);
    $("#recomendacion").prop('disabled', true);
    $("#ciudad").prop('disabled', true);
    $("#os").prop('disabled', true);
    $("#afiliado").prop('disabled', true);
    $("#email").prop('disabled', true);
    $("#guardar").prop('hidden', true);
    $("#descartar").prop('hidden', true);
    $("#nuevo").prop('hidden', false);
    $("#form-paciente")[0].reset();
}

function DesactivarDNI(){
    $("#busqueda_dni").prop('readonly', true);
    $("#busqueda_dni").val("");
    $("#busqueda_nombre").prop('readonly', false);
}

function DesactivarNombre(){
    $("#busqueda_dni").prop('readonly', false);
    $("#busqueda_nombre").prop('readonly', true);
    $("#busqueda_nombre").val("");
}


function Completar(id_fila){
    //vaciamos la tabla HC 

    $(".otrafila").remove();
    $(".otrafilaHC").remove();
    $(".otrafilaCte").remove();
    $(".otrafilaLaboratorio").remove();

    $("#HC").prop('hidden', false);
    $("#observaciones").prop('hidden', false);
    $("#Asistencias").prop('hidden', false);
    $("#Inasistencias").prop('hidden', false);
    $("#CuentaCte").prop('hidden', false);
    $("#Laboratorio").prop('hidden', false);


    $("#menu-2").prop('hidden', false);

    valoringresado = id_fila;
     if(valoringresado != "" ){
         //aca obtenemos los datos del paciente
        $.post("ObtenerDatosPaciente.php",{valorBusqueda:valoringresado}, function(description) {
            if(description != ""){
               var description = description.split('@#');
               $( "#id_paciente" ).val(valoringresado);
               $( "#id_paciente2" ).val(valoringresado);

               $("#facebook").prop('disabled', false);
               $( "#facebook" ).val(description[13]);
               $( "#nombre" ).prop( "disabled", false );
               $( "#nombre" ).val(description[1]);
               $("#apellido").prop('disabled', false);
               $( "#apellido" ).val(description[2]);
               $("#dni").prop('disabled', false);
               $( "#dni" ).val(description[0]);
               $("#domicilio").prop('disabled', false);
               $( "#domicilio" ).val(description[3]);
               $("#fecha_nac").prop('disabled', false);
               $( "#fecha_nac" ).val(description[4]);
               $("#celular").prop('disabled', false);
               $( "#celular" ).val(description[5]);
               $("#tel2").prop('disabled', false);
               $( "#tel2" ).val(description[6]);
               $("#recomendacion").prop('disabled', false);
               $( "#recomendacion" ).val(description[7]);
               $("#ciudad").prop('disabled', false);
               $( "#ciudad" ).val(description[8]);
               $("#os").prop('disabled', false);
               $( "#os" ).val(description[9]);
               $("#afiliado").prop('disabled', false);
               $( "#afiliado" ).val(description[10]);
               $("#email").prop('disabled', false);
               $( "#email" ).val(description[11]);
               $( "#observaciones_1" ).val(description[12]);
               $("#nro_hc").prop('disabled', false);
               $("#activo").prop('disabled', false);
               $( "#nro_hc" ).val(description[14]);
               $( "#activo" ).val(description[15]);
               $("#editar").prop('hidden', true);
               $("#guardar").prop('hidden', true);
               $("#actualizar").prop('hidden', false);
               $("#borrar").prop('hidden', false);
               $("#descartar").prop('hidden', true);
               $("#nuevo").prop('hidden', true);
               $("#cerrarficha").prop('hidden', false);

            };
        });

        //Aca vamos a obtener la HC

        $.post("ObtenerHC.php",{valorBusqueda:valoringresado}, function(hc) {
            if(hc != ""){
               var hc = hc.split('@#');
               var i ;
               cantidad = hc.length-1;
               for (i=0;i<cantidad;i+=4){
                url = ''+hc[i+3]+'';
                var htmlTags = `<tr class="otrafilaHC" onclick="VerImagen('`+url+`');">`+
                '<th scope="row">' + hc[i] + '</th>'+
                '<td>' + hc[i+1] + '</td>'+
                '<td>' + hc[i+2] + '</td>'+
                '<td>' + '<button type="button" class="b-0 p-1 btn btn-primary btn2" data-toggle="modal" data-target="#MostrarImagen"> Ver </button>' + '</td>'+
                '</tr>';
                $('#tabla-hc').append(htmlTags);
                }
            };
        });

        //Aca vamos a obtener las asistencias

        $.post("ObtenerAsistencias.php",{valorBusqueda:valoringresado}, function(hc) {
            if(hc != ""){
               var hc = hc.split('@#');
               var i ;
               cantidad = hc.length-1;

                for (i=0;i<cantidad;i+=2){

                 var htmlTags = '<tr class="otrafila">'+
                '<th scope="row">' + hc[i] + '</th>'+
                '<td>' + hc[i+1] + '</td>'+
                '</tr>';
            
                $('#tabla-asistencias').append(htmlTags);
                }
            };
        });

        //Aca vamos a obtener las inasistencias
        $.post("ObtenerInasistencias.php",{valorBusqueda:valoringresado}, function(hc) {
            if(hc != ""){
               var hc = hc.split('@#');
               var i ;
               cantidad = hc.length-1;

                for (i=0;i<cantidad;i+=2){

                 var htmlTags = '<tr class="otrafila">'+
                '<th scope="row">' + hc[i] + '</th>'+
                '<td>' + hc[i+1] + '</td>'+
                '</tr>';
            
                $('#tabla-inasistencias').append(htmlTags);
                }
            };
        });

        //Aca vamos a obtener la cte
        $.post("ObtenerCte.php",{valorBusqueda:valoringresado}, function(hc) {
            if(hc != ""){
               var hc = hc.split('@#');
               var i ;
               cantidad = hc.length-1;

                for (i=0;i<cantidad;i+=4){

                 var htmlTags = '<tr class="otrafilaCte">'+
                '<th scope="row">' + hc[i] + '</th>'+
                '<td>' + hc[i+1] + '</td>'+
                '<td>' + hc[i+2] + '</td>'+
                '<td>' + hc[i+3] + '</td>'+
                '</tr>';                
                $('#tabla-cte').append(htmlTags);
                }                
                posicion=hc.length-1;
                saldo = hc[posicion];

                var htmlTags = '<tr class="otrafilaCte" style="background:WHITE;">'+
                '<th scope="row">' + '</th>'+
                '<td>' + "<b>SALDO AL DIA DE HOY</b>" + '</td>'+
                '<td> <b>' + saldo + '</b> </td>'+
                '<td>' + '</td>'+
                '</tr>';                
                $('#tabla-cte').append(htmlTags);
            };
        });

        //Aca obtenemos los laboratorios

        $.post("ObtenerLaboratorio.php",{valorBusqueda:valoringresado}, function(hc) {
            if(hc != ""){
            var hc = hc.split('@#');
            var i ;
            cantidad = hc.length-1;

                for (i=0;i<cantidad;i+=4){

                var htmlTags = '<tr class="otrafilaLaboratorio">'+
                '<th scope="row">' + hc[i] + '</th>'+
                '<td>' + hc[i+1] + '</td>'+
                '<td>' + hc[i+2] + '</td>'+
                '<td>' + hc[i+3] + '</td>'+
                '</tr>';                
                $('#tabla-laboratorio').append(htmlTags);
                }                
                posicion=hc.length-1;
                saldo = hc[posicion];

                var htmlTags = '<tr class="otrafilaLaboratorio" style="background:WHITE;">'+
                '<th scope="row">' + '</th>'+
                '<td>' + "<b>SALDO AL DIA DE HOY</b>" + '</td>'+
                '<td> <b>' + saldo + '</b> </td>'+
                '<td>' + '</td>'+
                '</tr>';                
                $('#tabla-laboratorio').append(htmlTags);
            };
        });



     };

};

function NuevoMovimientoHC(){
    var paciente = $( "#id_paciente" ).val();

    var formData = new FormData(document.getElementById("formNuevoHC"));
    formData.append("id_paciente_2", paciente);


    $.ajax({
        url: "recibe.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    })
        .done(function(res){
            alert("Movimiento cargado con exito!");
            $(".otrafilaHC").remove();
           //Aca vamos a obtener la HC
            $.post("ObtenerHC.php",{valorBusqueda:valoringresado}, function(hc) {
                if(hc != ""){
                var hc = hc.split('@#');
                var i ;
                cantidad = hc.length-1;

                    for (i=0;i<cantidad;i+=4){
                    url = ''+hc[i+4]+'';
                    var htmlTags = `<tr class="otrafilaHC" onclick="VerImagen('`+url+`');">`+
                    '<th scope="row">' + hc[i] + '</th>'+
                    '<td>' + hc[i+1] + '</td>'+
                    '<td>' + hc[i+2] + '</td>'+
                    '<td>' + '<button type="button" class="b-0 p-1 btn btn-primary btn2" data-toggle="modal" data-target="#MostrarImagen"> Ver </button>' + '</td>'+
                    '</tr>';
                    $('#tabla-hc').append(htmlTags);
                    }
                };
            });
            //fin del insertar
        });

    $('#NuevoHC').modal('hide')

}

function NuevoMovimientoCte(){
    var telefono  = $("#celular").val();
    var fecha = $( "#fechaMov" ).val();
    var tipo = $( "#tipoMov" ).val();
    var importe = $( "#importeMov" ).val();
    var detalle = $( "#detalleMov" ).val();
    var paciente = $( "#id_paciente" ).val();
    
    var movimiento = paciente+'@#'+fecha+'@#'+tipo+'@#'+importe+'@#'+detalle;

    //Aca vamos a insertar el movimiento
    $.post("InsertarMovimientoCte.php",{valorBusqueda:movimiento}, function(rta) {
       if(rta=="OK"){
           alert("Movimiento cargado con éxito!");
           $(".otrafilaCte").remove();
           var mensaje = "Se Registro un nuevo pago de $ "+importe; 
            elementos=telefono+'@#'+mensaje;
            $.post("EnviarAlerta.php",{valorBusqueda:elementos}, function(rta) {
                rta="OK";
            });
           //aca vamos a obtener la cte
                $.post("ObtenerCte.php",{valorBusqueda:paciente}, function(hc) {
                    if(hc != ""){
                    var hc = hc.split('@#');
                    var i ;
                    cantidad = hc.length-1;

                        for (i=0;i<cantidad;i+=4){

                        var htmlTags = '<tr class="otrafilaCte">'+
                        '<th scope="row">' + hc[i] + '</th>'+
                        '<td>' + hc[i+1] + '</td>'+
                        '<td>' + hc[i+2] + '</td>'+
                        '<td>' + hc[i+3] + '</td>'+
                        '</tr>';                
                        $('#tabla-cte').append(htmlTags);
                        }                
                        posicion=hc.length-1;
                        saldo = hc[posicion];

                        var htmlTags = '<tr class="otrafilaCte" style="background:WHITE;">'+
                        '<th scope="row">' + '</th>'+
                        '<td>' + "<b>SALDO AL DIA DE HOY</b>" + '</td>'+
                        '<td> <b>' + saldo + '</b> </td>'+
                        '<td>' + '</td>'+
                        '</tr>';                
                        $('#tabla-cte').append(htmlTags);
                    };
                });
            //fin del insertar

       }else{
            alert("Error al cargar nuevo movimiento");
       };
    });

    //envio de alerta SMS
    

    $('#NuevoCte').modal('hide')

}

function CerrarFicha(){
    $("#facebook").prop('disabled', true);
    $("#menu-2").prop('hidden', true);
    $( "#nombre" ).prop( "disabled", true );
    $("#apellido").prop('disabled', true);
    $("#dni").prop('disabled', true);
    $("#domicilio").prop('disabled', true);
    $("#fecha_nac").prop('disabled', true);
    $("#celular").prop('disabled', true);
    $("#nro_hc").prop('disabled', true);
    $("#activo").prop('disabled', true);
    $("#celular").prop('disabled', true);
    $("#tel2").prop('disabled', true);
    $("#recomendacion").prop('disabled', true);
    $("#ciudad").prop('disabled', true);
    $("#os").prop('disabled', true);
    $("#afiliado").prop('disabled', true);
    $("#email").prop('disabled', true);
    $("#guardar").prop('hidden', true);
    $("#descartar").prop('hidden', true);
    $("#nuevo").prop('hidden', false);
    $("#cerrarficha").prop('hidden', true);
    $("#actualizar").prop('hidden', true);
    $("#borrar").prop('hidden', true);
    $("#HC").prop('hidden', true);
    $("#observaciones").prop('hidden', true);
    $("#Asistencias").prop('hidden', true);
    $("#Inasistencias").prop('hidden', true);
    $("#CuentaCte").prop('hidden', true);
    $("#Laboratorio").prop('hidden', true);





    $("#form-paciente")[0].reset();
}


function NuevoMovimientoLaboratorio(){
    var fecha = $( "#fechaLab" ).val();
    var tipo = $( "#tipoLab" ).val();
    var importe = $( "#importeLab" ).val();
    var detalle = $( "#detalleLab" ).val();
    var paciente = $( "#id_paciente" ).val();
    
    var movimiento = paciente+'@#'+fecha+'@#'+tipo+'@#'+importe+'@#'+detalle;
    //Aca vamos a insertar el movimiento
    $.post("InsertarMovimientoLaboratorio.php",{valorBusqueda:movimiento}, function(rta) {
       if(rta=="OK"){
           alert("Movimiento cargado con éxito!");
           $(".otrafilaLaboratorio").remove();
           //aca vamos a obtener la LISTA DE lAB
                $.post("ObtenerLaboratorio.php",{valorBusqueda:paciente}, function(hc) {
                    if(hc != ""){
                    var hc = hc.split('@#');
                    var i ;
                    cantidad = hc.length-1;

                        for (i=0;i<cantidad;i+=4){

                        var htmlTags = '<tr class="otrafilaLaboratorio">'+
                        '<th scope="row">' + hc[i] + '</th>'+
                        '<td>' + hc[i+1] + '</td>'+
                        '<td>' + hc[i+2] + '</td>'+
                        '<td>' + hc[i+3] + '</td>'+
                        '</tr>';                
                        $('#tabla-laboratorio').append(htmlTags);
                        }                
                        posicion=hc.length-1;
                        saldo = hc[posicion];

                        var htmlTags = '<tr class="otrafilaLaboratorio" style="background:WHITE;">'+
                        '<th scope="row">' + '</th>'+
                        '<td>' + "<b>SALDO AL DIA DE HOY</b>" + '</td>'+
                        '<td> <b>' + saldo + '</b> </td>'+
                        '<td>' + '</td>'+
                        '</tr>';                
                        $('#tabla-laboratorio').append(htmlTags);
                    };
                });
            //fin del insertar

       }else{
            alert("Error al cargar nuevo movimiento");
       };
    });
    

    $('#NuevoLaboratorio').modal('hide')

}

function VerImagen(url){
    $("#ImagenHC_1").attr("src",url);
}

function BorrarPaciente(){
    id = $("#id_paciente").val();
    $("#paciente_borrar").val(id);
    $('#BorrarPaciente').modal('show'); 

}

function BorrarPaciente2(){
    id = $("#paciente_borrar").val();
    password = $("#password").val();

    datos = id+"@#"+password;

    $.post("EliminarPaciente.php",{valorBusqueda:datos}, function(hc) {
            if(hc=="OK"){
                alert("Paciente borrado con éxito.");
                $('#BorrarPaciente').modal('hide');
                location.reload();
            }else{
                alert("CONTRASEÑA ERRONEA, REINTENTE.");
            }
    });

}



