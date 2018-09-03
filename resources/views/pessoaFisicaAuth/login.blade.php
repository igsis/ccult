@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('pessoaFisica.home') }}">{!! config('adminlte.logo', '<b>CCULT</b>') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="container">
                <h3>Login Pessoa Física</h3><br>
            </div>
            <form action="{{ route('pessoaFisica.login') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
                    <input type="text" name="cpf" id="CPF" class="form-control" value="{{ old('cpf') }}"
                           placeholder="CPF">
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
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
                <div class="row">
                    <div class="col-xs-6">
                        <a href="/" class="btn btn-default btn-block btn-flat"> Voltar</a>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="auth-links">
                <!-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a> -->
                <br>
                <a href="{{route('pessoaFisica.register')}}"
                       class="text-center">
                       Cadastrar uma Pessoa Física
                </a>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>

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

