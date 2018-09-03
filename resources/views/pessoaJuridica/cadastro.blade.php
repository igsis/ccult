@extends('adminlte::page')

@section('title', 'Cadastro de Pessoa Fisica')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Seu Cadastro</h3>
    	</div>

    	<form role="form" method="post" action="{{route('pessoaJuridica.atualizar')}}">
    		{{ csrf_field() }}
    		<div class="box-body">
    			<div class="form-group has-feedback {{ $errors->has('razaoSocial') ? ' has-error' : '' }}">
    				<label for="">Razão Social</label>
    				<input type="text" class="form-control" id="" name="razaoSocial" value="{{ $pessoaJuridica->razao_social }}" placeholder="Razao Social">
    			</div>
				<div class="form-group">
    				<label for="">CCM</label>
    				<input type="text" class="form-control" id="" name="ccm" value="{{ $pessoaJuridica->ccm }}" placeholder="Passaporte">
    			</div>
    			<div class="form-group">
    				<label for="">CNPJ</label>
    				<input type="text" class="form-control" id="CNPJ" value="{{ $pessoaJuridica->cnpj }}" disabled>
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
	    			<label for="email">E-mail</label>
	    			<div class="input-group">
	    				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	    				<input type="email" class="form-control" name="email" placeholder='example@email.com' value="{{ $pessoaJuridica->email }}">
	    			</div>
	    		</div>
    		</div>

    		<div class="box-footer">
    			<button type="submit" class="btn btn-primary">Atualizar Cadastro</button>
    		</div>
    	</form>
	</div>
	
    	
@stop

@section('js')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>

	<script>
        $(document).ready(function () { 
            let $seuCampoCnpj = $("#CNPJ");
            $seuCampoCnpj.mask('99.999.999/9999-99', {reverse: true});
        });
    </script>
@stop

