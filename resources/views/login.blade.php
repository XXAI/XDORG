@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('javascript')
    <script src="{{asset('js/modules/login.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            <img src="{{asset('images/LOGOS-01.jpg')}}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-6">
        </div>
        <div class="col-3">
            <img src="{{asset('images/LOGOS-03.jpg')}}" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row">
        <div class="offset-lg-4 col-lg-4 col-md col-sm">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">Iniciar Sesión</h5>
                </div>
                <div class="card-body">
                    <form method="post" id="form-login">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario">
                                    <div id="error_usuario" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <div id="error_password" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col offset-md-6 col-md-6 col-lg-6 offset-lg-6">
                            <button type="button" class="btn btn-primary btn-block" onclick="login();">Entrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection