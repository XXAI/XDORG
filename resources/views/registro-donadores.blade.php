@extends('layouts.app')

@section('title', 'Registro Donadores')

@section('javascript')
    <script src="{{asset('js/modules/registro-donadores.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="offset-lg-1 col-lg-10 col-md col-sm">

            <div id="mensaje-guardado" class="card border-success mb-3 text-center" style="display:none;">
                <div class="card-header">Guardado Correctamente</div>
                <div class="card-body text-success">
                    <h5 class="card-title">Los datos se han guardado con éxito</h5>
                    <p class="card-text">Presione el boton para regresar al formulario de registro.</p>
                    <button type="button" class="btn btn-success" onclick="mostrarFormularioRegistro()"><i class="fas fa-arrow-left"></i> Regresar al Formulario</button>
                </div>
            </div>

            <div id="formulario-registro" class="card">
                <div class="card-header text-center">
                    <h5 class="card-title">Datos del solicitante</h5>
                </div>
                <div class="card-body">
                    <form method="post" id="form-donador">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="form-row">
                            <div class="col-md col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                    <div id="error_nombre" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Apellido Paterno</label>
                                    <input type="text" class="form-control" name="a_paterno" id="a_paterno">
                                    <div id="error_a_paterno" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Apellido Materno</label>
                                    <input type="text" class="form-control" name="a_materno" id="a_materno">
                                    <div id="error_a_materno" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md col-sm-8 col-10">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" onchange="calcularEdad()">
                                    <div id="error_fecha_nacimiento" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-4 col-2">
                                <div class="form-group">
                                    <label>Edad</label>
                                    <input type="text" class="form-control" name="edad" id="edad" readonly>
                                    <div id="error_edad" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-7 col-12">
                                <div class="form-group">
                                    <label>CURP</label>
                                    <input type="text" class="form-control" name="curp" id="curp">
                                    <div id="error_curp" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-5 col-12">
                                <div class="form-group">
                                    <label>Genero</label>
                                    <select class="form-control" name="genero" id="genero">
                                        <option value="">Seleccione un Genero</option>
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                    <div id="error_genero" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md col-sm-4 col-12">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado_id" id="estado_id">
                                        <option value="">Seleccione un estado</option>
                                        @foreach($estados as $estado)
                                        <option value="{{$estado->id}}" {{($estado->id == 7)?'selected':''}}>{{$estado->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <div id="error_estado_id" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-5 col-12">
                                <div class="form-group">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" id="ciudad">
                                    <div id="error_ciudad" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-3 col-12">
                                <div class="form-group">
                                    <label>Código Postal</label>
                                    <input type="text" class="form-control" name="codigo_postal" id="codigo_postal">
                                    <div id="error_codigo_postal" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Correo Electrónico</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                    <div id="error_email" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Telefono de contacto</label>
                                    <input type="email" class="form-control" name="telefono_contacto" id="telefono_contacto">
                                    <div id="error_telefono_contacto" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer captura-formulario">
                    <div class="row">
                        <div class="col offset-md-6 col-md-6 col-lg-3 offset-lg-9">
                            <button class="btn btn-primary btn-block" onclick="enviarFormulario()">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection