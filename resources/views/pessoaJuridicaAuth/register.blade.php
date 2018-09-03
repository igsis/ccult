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
                <h3>Cadastro de Pessoa Jurídica</h3><br>
            </div>
            <form action="{{ route('pessoaJuridica.register') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('razao_social') ? 'has-error' : '' }}">
                    <input type="text" name="razao_social" class="form-control" value="{{ old('razao_social') }}"
                           placeholder="Razão Social">
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                    @if ($errors->has('razao_social'))
                        <span class="help-block">
                            <strong>{{ $errors->first('razao_social') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('cnpj') ? 'has-error' : '' }}">
                 <input type="text" name="cnpj" id="CNPJ" class="form-control" value="{{ old('cnpj') }}"
                           placeholder="CNPJ">
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                    @if ($errors->has('cnpj'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cnpj') }}</strong>
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
            </form>
            <div class="auth-links">
                <a href="{{route('pessoaJuridica.formLogin')}}"
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
            let $seuCampoCnpj = $("#CNPJ");
            $seuCampoCnpj.mask('99.999.999/9999-99', {reverse: true});
        });
    </script>

    @yield('js')
@stop
