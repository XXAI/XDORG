@extends('layouts.app')

@section('title', 'Listado Donadores')

@section('javascript')
    <script src="{{asset('js/modules/donadores.js')}}"></script>
@endsection

@section('content')
<div class="card-body bg-light">
    <form id="formulario-filtro" onkeydown="return event.key != 'Enter';">
        <div class="form-row">
            <div class="col-6 col-md">
                <input type="text" class="form-control" name="buscar" id="buscar" placeholder="Buscar" onkeydown="buscarPalabra(event)">
            </div>
            <div class="col-6 col-md-2">
                <select name="tipo_genero" id="tipo_genero" class="form-control">
                    <option value='' selected="selected">Filtrar por Sexo</option>
                    <option value='M'>Masculino</option>
                    <option value='F'>Femenino</option>
                </select>
            </div>
            <div class="col-12 col-md-2 col-bg-1">
                <button type="button" class="btn btn-primary btn-block" onclick="aplicarFiltro()">Aplicar</button>
            </div>
            <div>
                <button type="button" class="btn btn-light" onclick="exportarExcel()"><i class="fas fa-file-excel"></i></button>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive" style="padding-bottom:40px;">
    <table class="table table-sm table-hover">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>Nombre Completo</th>
                <th>Fecha Nacimiento</th>
                <th>CURP</th>
                <th>Genero</th>
                <th>Ciudad</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody id="lista-registros">
            <tr><th colspan="6" class="text-center"><i class="fas fa-spinner fa-pulse"></i> Cargando...</th></tr>
        </tbody>
    </table>
</div>

<ul class="nav justify-content-center fixed-bottom bg-light ">
    <span class="navbar-text">
        Total Registros: <span id="span-total-registros">1</span>
    </span>
    <li class="nav-item">
        <a class="pagina-anterior-primera btn btn-outline-primary ml-sm-2 mr-sm-2 my-2 my-sm-0 disabled" href="#" tabindex="-1" aria-disabled="true" onclick="cargarPagina('primera')"><i class="fas fa-angle-double-left"></i> Primer Página</a>
    </li>
    <li class="nav-item">
        <a class="pagina-anterior-primera btn btn-outline-primary mr-sm-2 my-2 my-sm-0 disabled" href="#" tabindex="-1" aria-disabled="true" onclick="cargarPagina('anterior')"><i class="fas fa-angle-left"></i> Anterior</a>
    </li>
    <li>
        <form class="form-inline my-2 my-lg-0">
            <input type="number" class="form-control mr-sm-2" placeholder="Página" aria-label="Pagina" id="pagina-actual" value="1">
            <button type="button" class="btn btn-outline-primary my-2 my-sm-0" onclick="cargarPagina()">Ir</button>
        </form>
    </li>
    <li class="nav-item">
        <a class="pagina-siguiente-ultima btn btn-outline-primary ml-sm-2 mr-sm-2 my-2 my-sm-0" href="#" onclick="cargarPagina('siguiente')">Siguiente <i class="fas fa-angle-right"></i></a>
    </li>
    <li class="nav-item">
        <a class="pagina-siguiente-ultima btn btn-outline-primary mr-sm-2 my-2 my-sm-0" href="#" onclick="cargarPagina('ultima')">Ultima Página <i class="fas fa-angle-double-right"></i></a>
    </li>
    <span class="navbar-text">
        Total Paginas:<span id="span-total-paginas">1</span>
        <input type="hidden" id="total-paginas">
    </span>
</ul>
@endsection