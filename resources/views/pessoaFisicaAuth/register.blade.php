@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>CCULT</b>') !!}</a>
        </div>

        <div class="register-box-body">
        <div class="container">
                <h3>Cadastro de Pessoa Física</h3><br>
            </div>
            <form action="{{ route('pessoaFisica.register') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
                    <input type="text" name="nome" class="form-control" value="{{ old('nome') }}"
                           placeholder="Nome">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
                    <input type="text" name="cpf" id="CPF" class="form-control" value="{{ old('cpf') }}"
                           placeholder="CPF">
                    <span class="glyphicon glyphicon-ser form-control-feedback"></span>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('rg_rne') ? 'has-error' : '' }}">
                    <input type="text" name="rg_rne" class="form-control" value="{{ old('rg_rne') }}"
                           placeholder="RG - RNE">
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                    @if ($errors->has('rg_rne'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rg_rne') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('passaporte') ? 'has-error' : '' }}">
                    <input type="text" name="passaporte" class="form-control" value="{{ old('passaporte') }}"
                           placeholder="Passaporte">
                    <span class="glyphicon glyphicon-ser form-control-feedback"></span>
                    @if ($errors->has('passaporte'))
                        <span class="help-block">
                            <strong>{{ $errors->first('passaporte') }}</strong>
                        </span>
                    @endif
                </div>     

                <div class="form-group has-feedback {{ $errors->has('data_nascimento') ? 'has-error' : '' }}">
                    <input type="date" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}"
                           placeholder="Data de Nascimento">
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                    @if ($errors->has('data_nascimento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('data_nascimento') }}</strong>
                        </span>
                    @endif
                </div>  

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >Cadastrar</button>
                <a href="/"
                        class="btn btn-default btn-block btn-flat"
                >Voltar</a>
            </form>
            <div class="auth-links">
                <a href="{{ route('pessoaFisica.formLogin') }}"
                   class="text-center">Já sou cadastrado</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>

    <script>
        $(document).ready(function () { 
            let $seuCampoCpf = $("#CPF");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
    </script>
    @yield('js')
@stop
