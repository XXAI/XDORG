function validarCURP(){
    if(curp.length == 18){
        //
    }
}

function enviarFormulario(){
    var parametros = $("#form-donador").serialize();
    limpiarErroresFormulario();
    
    $.post('api/donadores', parametros, function(data){
        if(data.validacion){
            $('#formulario-registro').hide();
            $('#mensaje-guardado').show();
            //$('#btn-guardar').html('<i class="fas fa-save"></i> Actualizar');
            //$('#btn-continuar').show();
        }else{
            for(var i in data.errores){
                var errores = data.errores[i].join('<br>');
                $('#'+i).addClass('is-invalid');
                $('#error_'+i).text(errores);
            }
        }
    });
}

function mostrarFormularioRegistro(){
    limpiarFormulario();
    $('#mensaje-guardado').hide();
    $('#formulario-registro').show();
}

function limpiarErroresFormulario(){
    $('#form-donador .is-invalid').removeClass('is-invalid');
    $('#form-donador .invalid-feedback').text('');
}

function limpiarFormulario(){
    $('#form-donador').trigger('reset');
    limpiarErroresFormulario();
}

function calcularEdad(){
    var birthDate = new Date($('#fecha_nacimiento').val());
    var ageDifMs = Date.now() - birthDate.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    var edad = Math.abs(ageDate.getUTCFullYear() - 1970);
    $('#edad').val(edad);
}

window.onload = function () { 
    //
}

//Agregamos shortcuts para put y delete en las llamadas ajax de jquery
jQuery.each( [ "put", "delete" ], function( i, method ) {
    jQuery[ method ] = function( url, data, callback, type ) {
      if ( jQuery.isFunction( data ) ) {
        type = type || callback;
        callback = data;
        data = undefined;
      }
   
      return jQuery.ajax({
        url: url,
        type: method,
        dataType: type,
        data: data,
        success: callback
      });
    };
});