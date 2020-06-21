function AbrirNuevoTurno(turno){
    $(".OpcionHorarioHasta").remove();
    var hc = turno.split('@#');
    $('#horaIn').val(hc[0]);
    $('#id_profesional').val(hc[1]);
    profesional = hc[1];
    hora_ini = hc[0];
    datos = profesional+"@#"+hora_ini;
    $.post("ObtenerRangoHorario.php",{valorBusqueda:datos}, function(rta) {
        var hc = rta.split('@#');
           cantidad = hc.length;
            for (i=2;i<cantidad;i++){
             var htmlTags = '<option class="OpcionHorarioHasta" value="'+hc[i]+'">'+hc[i]+'</option>';
        
            $('#horaFin').append(htmlTags);
            }
        
    });

    $('#NuevoTurno').modal('show');
}

function BuscarPacientes(){ 

    $(".filaBusqueda").remove();

    valoringresado = $('#buscarPaciente').val();

    $.post("ObtenerPacientes.php",{valorBusqueda:valoringresado}, function(hc) {
        if(hc != ""){
           var hc = hc.split('@#');
           var i ;
           cantidad = hc.length-1;

            for (i=0;i<cantidad;i+=4){

             var htmlTags = '<tr class="filaBusqueda" style="cursor:pointer;" onclick="CargarDatosTurno('+hc[i+3]+');">' +
            '<th scope="row">' + hc[i+2] + '</th>' +
            '<td>' + hc[i] + '</td>'+
            '<td>' + hc[i+1] + '</td>'+
            '</tr>';
        
            $('#tabla-busq').append(htmlTags);
            }
        };
    });

    $("#tabla-bus").prop('hidden', false);

}

function CargarDatosTurno(id){
    $('#nuevoPacienteTurno').prop('hidden',true);
    $("#id_paciente").val(id);
    $("#tabla-bus").prop('hidden', true);
    $("#tabla-ingreso").prop('hidden', true);
    $('#formNuevoTurno2').prop('hidden',false);
    $('#nuevoturnofinal').prop('hidden',false);  
    $.post("ObtenerNombrePaciente.php",{valorBusqueda:id}, function(hc) {
        if(hc != ""){
           $("#nombrePaciente").val(hc);
        };
    });

}

function CerrarTurno(){
    $(".filaBusqueda").remove();
    $("id_paciente").val("");
    $("#nombrePaciente").val("");
    $("#observacionesTurno").val("");
    $("#estado_turno").val("");
    $("#horaFin").val("");
    $("#tabla-bus").prop('hidden', true);
    $("#tabla-ingreso").prop('hidden', false);
    $('#formNuevoTurno2').prop('hidden',true);
    $('#nuevoturnofinal').prop('hidden',true);  
    $('#formNuevoPacienteTurno').prop('hidden',true);
    $('#nuevoPacienteTurno').prop('hidden',false);
}

function NuevoTurnoFinal(){
    $('#nuevoPacienteTurno').prop('hidden',true);
    paciente = $("#id_paciente").val();
    fecha = $("#fecha_turno").val();
    estado = $("#estado_turno").val();
    medico = $("#id_profesional").val();
    horaIn = $("#horaIn").val();
    horaFin = $("#horaFin").val();
    laboratorio = $("#laboratorio").val();
    conta=4;
    if(horaFin==null){
        alert("Debe completar la hora de finalizacion del turno");
    }else{
        conta++;
    };
    observaciones = $("#observacionesTurno").val();
    if(estado == null){
        alert("Debe completar el estado del turno");
    }else{
        conta++;
    };
    if(conta==6){
        datos = paciente+"@#"+fecha+"@#"+estado+"@#"+medico+"@#"+horaIn+"@#"+horaFin+"@#"+observaciones+"@#"+laboratorio;        
        $.post("InsertarTurno.php",{valorBusqueda:datos}, function(hc) {
        });
        $("id_paciente").val("");
        $("#nombrePaciente").val("");
        $("#observacionesTurno").val("");
        $("#estado_turno").val("");
        $("#horaFin").val("");
        $("#tabla-bus").prop('hidden', true);
        $("#tabla-ingreso").prop('hidden', false);
        $('#formNuevoTurno2').prop('hidden',true);
        $('#nuevoturnofinal').prop('hidden',true);  

        alert("Turno cargado con éxito");
    
        location.reload();
       
    };

    
    
}

function NuevoPacienteTurno(){
    $('#formNuevoPacienteTurno').prop('hidden',false);
    $('#tabla-ingreso').prop('hidden',true);
    $('#nuevoPacienteTurno').prop('hidden',true);

}

function NuevoPacienteRapido(){
    conta=0;
    apellido = $('#apellidoPacienteTurno').val();
    if(apellido==null){
        alert("DEBE COMPLETAR APELLIDO")
    }else{
        conta++;
    };
    nombre = $('#nombrePacientTurno').val();
    if(nombre==null){
        alert("DEBE COMPLETAR NOMBRE")
    }else{
        conta++;
    };
    celular = $('#celularPacienteTurno').val();
    if(celular==null){
        alert("DEBE COMPLETAR TELEFONO");
    }else{
        conta++;
    };
    if(conta==3){
        datos = apellido+"@#"+nombre+"@#"+celular;
        $.post("InsertarPacienteRapido.php",{valorBusqueda:datos}, function(hc) {
            if(hc=="OK"){
                alert ("Paciente cargado con éxito");
                dato = "";
                $.post("ObtenerUltimoPaciente.php",{valorBusqueda:dato}, function(id) {
                    CargarDatosTurno(id);        
                });
            }else{
                alert ("Error al cargar paciente");
            }
        });
    }

    
    
    $('#formNuevoPacienteTurno').prop('hidden',true);
    $('#tabla-ingreso').prop('hidden',false);
    

}

function VerTurno(id){
    $(".OpcionHorarioHasta").remove();

    $.post("ObtenerTurno.php",{valorBusqueda:id}, function(hc) {
        var turno = hc.split('@#');
        $('#id_turno').val(turno[0]);
        $('#nombrePaciente_verT').val(turno[1]);
        $('#id_pacienteV').val(turno[7]);
        $('#id_profV').val(turno[6]);
        $('#horaIn_verT').val(turno[3]);
        $('#horaFin_verT').val(turno[4]);
        $('#estado_turno_verT').val(turno[2]);
        $('#observaciones_verT').val(turno[5]);
        $('#laboratorio_verT').val(turno[8]);

        var htmlTags = '<option selected class="OpcionHorarioHasta" value="'+turno[3]+'">'+turno[3]+'</option>';
        
        $('#horaIn_verT').prepend(htmlTags);

        var htmlTags = '<option selected class="OpcionHorarioHasta" value="'+turno[4]+'">'+turno[4]+'</option>';
        
        $('#horaFin_verT').prepend(htmlTags);
        
        profesional = turno[6];
        datos = profesional;
        $.post("ObtenerRangoHorario.php",{valorBusqueda:datos}, function(rta) {
        var hc = rta.split('@#');
        var i ;
           cantidad = hc.length;
            for (i=2;i<cantidad;i+=1){
             var htmlTags = '<option class="OpcionHorarioHasta" value="'+hc[i]+'">'+hc[i]+'</option>';
        
            $('#horaIn_verT').append(htmlTags);
            }
        
         });

         profesional = turno[6];
         datos = profesional+"@#"+turno[3];

         $.post("ObtenerRangoHorario.php",{valorBusqueda:datos}, function(rta) {
            var hc = rta.split('@#');
            var i ;
               cantidad = hc.length;
                for (i=2;i<cantidad;i+=1){
                 var htmlTags = '<option class="OpcionHorarioFin" value="'+hc[i]+'">'+hc[i]+'</option>';
            
                $('#horaFin_verT').append(htmlTags);
                }
            
             });

        $('#VerTurno').modal('show');

    });
    

}

function CerrarVista(){
    $(".fila_agregada").remove();
}

function ActualizarTurno(){
        id =  $('#id_turno').val();
        id_paciente = $("#id_pacienteV").val();
        hora_ini = $('#horaIn_verT').val();
        hora_fin =  $('#horaFin_verT').val();
        estado = $('#estado_turno_verT').val();
        observaciones = $('#observaciones_verT').val();
        medico = $("#id_profV").val();
        laboratorio = $("#laboratorio_verT").val();
        datos = id+"@#"+hora_ini+"@#"+hora_fin+"@#"+estado+"@#"+observaciones+"@#"+id_paciente+"@#"+medico+"@#"+laboratorio;
        $.post("ActualizarTurno.php",{valorBusqueda:datos}, function(hc) {
            if(hc=="OK"){
                alert ("Turno actualizado con éxito");
                location.reload();

            }else{
                alert (hc);
            }
        });


}

function CalcularRangoHasta(){
    $(".OpcionHorarioFin").remove();
    hora_ini = $('#horaIn_verT').val();
    medico = $("#id_profV").val();
    datos = medico+"@#"+hora_ini;
    $.post("ObtenerRangoHorario.php",{valorBusqueda:datos}, function(rta) {
        var hc = rta.split('@#');
        var i ;
           cantidad = hc.length;
            for (i=2;i<cantidad;i+=1){

             var htmlTags = '<option class="OpcionHorarioFin" value="'+hc[i]+'">'+hc[i]+'</option>';
        
            $('#horaFin_verT').append(htmlTags);
            }
        
         });
}

function ActualizarAgenda(){

     $("#formFecha").submit();

}

function BorrarTurno(){
    turno = $("#id_turno").val();
    $.post("EliminarTurno.php",{valorBusqueda:turno}, function(hc) {        
            alert ("Turno eliminado con éxito");
            location.reload();     
    });
}

function AbrirDetalles(){
    $("#VerDetalles").modal('show');
    fecha = $("#fecha_agenda").val();
    $.post("ConsultarDetalles.php",{valorBusqueda:fecha}, function(hc) {        
          $('#detallesDelDia').val(hc);
    });
}

function GuardarDetalles(){
    fecha = $("#fecha_agenda").val();
    texto = $("#detallesDelDia").val();
    datos = fecha+"@#"+texto;
    $.post("ActualizarDetalles.php",{valorBusqueda:datos}, function(result) {        
        if(result=="OK"){
            alert("Texto guardado!");
        }else{
            alert("Error al guardar texto. Contacte al administrador");
        }
    });

    $("#VerDetalles").modal('hide');

    RevisarObservaciones();

}


function RevisarObservaciones(){
    fecha = $("#fecha_agenda").val();
    $.post("ConsultarDetalles.php",{valorBusqueda:fecha}, function(hc) {        
          if(hc!=""){
            $("#icon_detalles").css("color", "#FC6BDE");
          }else{
            $("#icon_detalles").css("color", "white");

          }
    });
}

function IrAFicha(){
    paciente = $("#id_pacienteV").val();
    Completar(paciente);
    $("#VerFichaPaciente").modal("show");
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
