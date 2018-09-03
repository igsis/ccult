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
            <a href="{{ route('pessoaJuridica.home') }}">{!! config('adminlte.logo', '<b>CCULT</b>') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="container">
                <h3>Login Pessoa Jurídica</h3><br>
            </div>
            <form action="{{ route('pessoaJuridica.login') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('cnpj') ? 'has-error' : '' }}">
                    <input type="text" name="cnpj" id="CNPJ" class="form-control" value="{{ old('cnpj') }}"
                           placeholder="CNPJ">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('cnpj'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cnpj') }}</strong>
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
                    <div class="col-xs-8">
                        <!-- <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                            </label>
                        </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="auth-links">
                <!-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                <br> -->
                <a href="{{route('pessoaJuridica.register')}}"
                       class="text-center">
                       Cadastrar uma Pessoa Jurídica
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
            let $seuCampoCnpj = $("#CNPJ");
            $seuCampoCnpj.mask('99.999.999/9999-99', {reverse: true});
        });
    </script>

    @yield('js')
@stop
