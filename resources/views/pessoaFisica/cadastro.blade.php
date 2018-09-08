@extends('adminlte::page')

@section('title', 'Cadastro de Pessoa Fisica')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Seu Cadastro</h3>
    	</div>

    	<form role="form" method="post" action="{{route('pessoaFisica.atualizar')}}">
    		{{ csrf_field() }}
    		<div class="box-body">
    			<div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
    				<label for="">Nome</label>
    				<input type="text" class="form-control" id="" name="nome" value="{{ $pessoaFisica->nome }}" placeholder="Nome">
    			</div>
    			<div class="form-group">
    				<label for="">Nome Social</label>
    				<input type="text" class="form-control" id="" name="nome_social" value="{{ $pessoaFisica->nome_social }}" placeholder="Nome Social">
    			</div>
    			<div class="form-group">
    				<label for="">Nome Artístico</label>
    				<input type="text" class="form-control" id="" name="nome_artistico" value="{{ $pessoaFisica->nome_artistico }}" placeholder="Nome Artístico">
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('rg_rne') ? ' has-error' : '' }}">
    				<label for="">RG - RNE</label>
    				<input type="text" class="form-control" name="rg_rne" value="{{ $pessoaFisica->rg_rne }}" placeholder="RG ou RNE">
    			</div>
    			<div class="form-group">
    				<label for="">Passaporte</label>
    				<input type="text" class="form-control" id="" name="passaporte" value="{{ $pessoaFisica->passaporte }}" placeholder="Passaporte">
    			</div>
				<div class="form-group">
    				<label for="">CCM</label>
    				<input type="text" class="form-control" id="" name="ccm" value="{{ $pessoaFisica->ccm }}" placeholder="Passaporte">
    			</div>
    			<div class="form-group">
    				<label for="">CPF</label>
    				<input type="text" class="form-control" id="CPF" value="{{ $pessoaFisica->cpf }}" disabled>
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('data_nascimento') ? ' has-error' : '' }}">
    				<label for="">Data de Nascimento</label>
    				<input type="date" class="form-control" id="" name="data_nascimento" value="{{ $pessoaFisica->data_nascimento }}" placeholder="01/01/1990">
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
	    			<label for="email">E-mail</label>
	    			<div class="input-group">
	    				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	    				<input type="email" class="form-control" name="email" placeholder='example@email.com' value="{{ $pessoaFisica->email }}">
	    			</div>
	    		</div>
    			<div class="form-group has-feedback {{ $errors->has('documento') ? ' has-error' : '' }}">
    				<label for="">Documento?</label>
    				<input type="file" name="documento" id="">

    				<p class="help-block">Arquivo de até 3 megas</p>
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
            let $seuCampoCpf = $("#CPF");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
    </script>
@stop
