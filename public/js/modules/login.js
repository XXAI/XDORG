function login(){
    $('#usuario').removeClass('is-invalid');
    $('#password').removeClass('is-invalid');
    var parametros = $("#form-login").serialize();

    $.post('api/login', parametros, function(data){
        console.log(data);
        if(data.validacion){
            window.location.href = 'donadores/';
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