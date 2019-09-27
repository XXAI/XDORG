function actualizarRegistros(){
    $('#lista-registros').html('<tr><th colspan="6" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando...</th></tr>');

    var parametros = $("#formulario-filtro").serialize();
    parametros += '&page='+$('#pagina-actual').val();

    $.get('api/donadores', parametros, function(data){
        var registros = "";
        
        for(var i in data['paginado'].data){
            var elemento = data['paginado'].data[i];
            var nombre_completo = elemento.a_paterno + " " + elemento.a_materno + " " + elemento.nombre;
            registros += "<tr><td>"+ nombre_completo +"</td><td class='text-center'>"+elemento.fecha_nacimiento+"</td><td class='text-center'>"+elemento.curp+"</td><td class='text-center'>"+elemento.genero+"</td><td class='text-center'>"+elemento.ciudad+"</td><td class='text-center'>"+elemento.created_at+"</td></tr>";
        }
        
        $('#lista-registros').html(registros);

        $('#total-paginas').val(data['paginado'].last_page);
        $('#span-total-paginas').text(data['paginado'].last_page);
        $('#span-total-registros').text(data['paginado'].total);

        actualizarPaginador();
    });
}

function actualizarPaginador(){
    var pag_actual = $('#pagina-actual').val();
    var total_paginas = $('#total-paginas').val();

    if(pag_actual == 1){
        $('.pagina-anterior-primera').attr('aria-disabled','true');
        $('.pagina-anterior-primera').attr('tabindex',-1);
        $('.pagina-anterior-primera').addClass('disabled');
    }else{
        $('.pagina-anterior-primera').attr('aria-disabled',false);
        $('.pagina-anterior-primera').attr('tabindex',false);
        $('.pagina-anterior-primera').removeClass('disabled');
    }

    if(pag_actual == total_paginas){
        $('.pagina-siguiente-ultima').attr('aria-disabled','true');
        $('.pagina-siguiente-ultima').attr('tabindex',-1);
        $('.pagina-siguiente-ultima').addClass('disabled');
    }else{
        $('.pagina-siguiente-ultima').attr('aria-disabled',false);
        $('.pagina-siguiente-ultima').attr('tabindex',false);
        $('.pagina-siguiente-ultima').removeClass('disabled');
    }
}

function buscarPalabra(event){
    if(event.key == 'Enter'){
        aplicarFiltro();
    }
}

function cargarPagina(pagina=''){
    var cargar_pagina = $('#pagina-actual').val()*1;
    var total_paginas = $('#total-paginas').val()*1;
    switch (pagina) {
        case 'siguiente':
            if(cargar_pagina < total_paginas){
                cargar_pagina++;
            }
            break;
        case 'anterior':
            if(cargar_pagina > 1){
                cargar_pagina--;
            }
            break;
        case 'primera':
            cargar_pagina = 1;
                break;
        case 'ultima':
            cargar_pagina = total_paginas;
            break;
        default:
            if(cargar_pagina > total_paginas){
                cargar_pagina = total_paginas;
            }else if(cargar_pagina < 0){
                cargar_pagina = 1;
            }
            break;
    }
    $('#pagina-actual').val(cargar_pagina);
    actualizarRegistros();
}

function aplicarFiltro(){
    $('#pagina-actual').val('1');
    actualizarRegistros();
}

function exportarExcel(){
    var parametros = $("#formulario-filtro").serialize();
    window.open('api/exportar-donadores?'+parametros,'_blank');
}

window.onload = function () { aplicarFiltro(); }

$(document).ready(function() {});