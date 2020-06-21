function Completar(id_fila){
    valoringresado = id_fila;
    $("#cerrarficha").prop('hidden', false);

    $("#datos_profesionales").prop('hidden', true);


     if(valoringresado != "" ){
         //aca obtenemos los datos del paciente
        $.post("ObtenerDatosProfesional.php",{valorBusqueda:valoringresado}, function(description) {
            if(description != ""){
               var description = description.split('@#');
               $( "#id_profesional" ).val(valoringresado);
               $( "#username" ).prop( "disabled", false );
               $( "#username" ).val(description[2]);
               $("#name").prop('disabled', false);
               $( "#name" ).val(description[1]);
               $("#password").prop('disabled', false);
               $( "#password" ).val(description[3]);
               $("#password2").prop('disabled', false);
               $( "#password2" ).val(description[3]);
               $("#tipo").prop('disabled', false);
               $( "#tipo" ).val(description[4]);
               $("#estado").prop('disabled', false);
               $( "#estado" ).val(description[5]);
               $("#hora_ini").prop('disabled', false);
               $( "#hora_ini" ).val(description[7]);
               $("#hora_fin").prop('disabled', false);
               $( "#hora_fin" ).val(description[8]);
               $("#tiempo").prop('disabled', false);
               $( "#tiempo" ).val(description[6]);

               if(description[4]=="PROFESIONAL"){
                $("#datos_profesionales").prop('hidden', false);
               }

               $("#editar").prop('hidden', true);
               $("#guardar").prop('hidden', true);
               $("#actualizar").prop('hidden', false);
               $("#descartar").prop('hidden', true);
               $("#nuevo").prop('hidden', true);

            };
        });

     };

};

function NuevoProfesional(){
    $( "#username" ).prop( "disabled", false );
    $("#name").prop('disabled', false);
    $("#password").prop('disabled', false);
    $("#password2").prop('disabled', false);
    $("#tipo").prop('disabled', false);
    $("#estado").prop('disabled', false);
    $("#hora_ini").prop('disabled', false);
    $("#hora_fin").prop('disabled', false);
    $("#tiempo").prop('disabled', false);
    $("#editar").prop('hidden', true);
    $("#guardar").prop('hidden', false);
    $("#actualizar").prop('hidden', true);
    $("#descartar").prop('hidden', true);
    $("#nuevo").prop('hidden', true);
    $("#cerrarficha").prop('hidden', false);
}

function VerificarTipo(){
    tipo = $("#tipo").val();
    if(tipo=="PROFESIONAL"){
        $("#datos_profesionales").prop('hidden', false);
    }else{
        $("#datos_profesionales").prop('hidden', true);
    }
}

function GuardarProfesional(){
    conta=0;
    username = $("#username").val();
    if(username==null){
        alert("Debe ingresar un nombre de usuario");
    }else{
        conta++;
    };
    name = $("#name").val();
    if(name==null){
        alert("Debe ingresar un Nombre");
    }else{
        conta++;
    };
    password = $("#password").val();
    if(password==null){
        alert("Debe ingresar una contraseña");
    }else{
        conta++;
    };
    password2 = $("#password2").val();
    if(password2==null){
        alert("Debe confirmar la contraseña");
    }else{
        conta++;
    };
    if( (password!=null) && (password2!=null) ){
        if(password==password2){
            conta++;
        }else{
            alert("Las constraseñas no son iguales");
        };
    };
    tipo = $("#tipo").val();
    if(tipo==null){
        alert("Debe elegir un tipo de usuario");
    }else{
        conta++;
    };
    estado = $("#estado").val();
    hora_ini = $("#hora_ini").val();
    hora_fin = $("#hora_fin").val();
    tiempo = $("#tiempo").val();
    if(tiempo==null){
        alert("Debe ingresar un lapso entre turnos");
    }else{
        conta++;
    };

    datos = username+"@#"+name+"@#"+password+"@#"+tipo+"@#"+estado+"@#"+hora_ini+"@#"+hora_fin+"@#"+tiempo;

    if(conta==7){
        $.post("InsertarProfesional.php",{valorBusqueda:datos}, function(hc) {
            if(hc=="YES"){
                alert ("Profesional cargado con exito");
                location.reload();
            }else{
                alert ("Error al cargar profesional");
            };
        });

    };

}

function CerrarFicha(){

    $( "#username" ).prop( "disabled", true );
    $("#name").prop('disabled', true);
    $("#password").prop('disabled', true);
    $("#password2").prop('disabled', true);
    $("#tipo").prop('disabled', true);
    $("#estado").prop('disabled', true);
    $("#hora_ini").prop('disabled', true);
    $("#hora_fin").prop('disabled', true);
    $("#tiempo").prop('disabled', true);
    $("#editar").prop('hidden', true);
    $("#guardar").prop('hidden', true);
    $("#actualizar").prop('hidden', true);
    $("#descartar").prop('hidden', true);
    $("#nuevo").prop('hidden', false);
    $("#cerrarficha").prop('hidden', true);
    $("#datos_profesionales").prop('hidden', true);
    $("#form-profesional")[0].reset();

}

function ActualizarProfesional(){
    conta=0;
    id=$("#id_profesional").val();
    username = $("#username").val();
    if(username==null){
        alert("Debe ingresar un nombre de usuario");
    }else{
        conta++;
    };
    name = $("#name").val();
    if(name==null){
        alert("Debe ingresar un Nombre");
    }else{
        conta++;
    };
    password = $("#password").val();
    if(password==null){
        alert("Debe ingresar una contraseña");
    }else{
        conta++;
    };
    password2 = $("#password2").val();
    if(password2==null){
        alert("Debe confirmar la contraseña");
    }else{
        conta++;
    };
    if( (password!=null) && (password2!=null) ){
        if(password==password2){
            conta++;
        }else{
            alert("Las constraseñas no son iguales");
        };
    };
    tipo = $("#tipo").val();
    if(tipo==null){
        alert("Debe elegir un tipo de usuario");
    }else{
        conta++;
    };
    estado = $("#estado").val();
    hora_ini = $("#hora_ini").val();
    hora_fin = $("#hora_fin").val();
    tiempo = $("#tiempo").val();
    if(tiempo==null){
        alert("Debe ingresar un lapso entre turnos");
    }else{
        conta++;
    };

    datos = username+"@#"+name+"@#"+password+"@#"+tipo+"@#"+estado+"@#"+hora_ini+"@#"+hora_fin+"@#"+tiempo+"@#"+id;

    if(conta==7){
        $.post("ActualizarProfesional.php",{valorBusqueda:datos}, function(hc) {
            if(hc=="YES"){
                alert ("Profesional actualizado con exito");
                location.reload();
            }else{
                alert ("Error al actualizar profesional");
            };
        });

    };

}
