@extends('adminlte::page')

@section('title', 'Cadastro de Pessoa Fisica')

@section('content_header')
    
@stop

@section('content')

	@include('erros.erros')
	@include('success.message')
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Cadastro de Pessoa Física</h3>
    	</div>

    	<form role="form" method="post" action="">
    		{{ csrf_field() }}
    		<div class="box-body">
    			<div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
    				<label for="">Nome</label>
    				<input type="text" class="form-control" id="" name="nome" value="{{ old('nome') }}" placeholder="Nome">
    			</div>
    			<div class="form-group">
    				<label for="">Nome Social</label>
    				<input type="text" class="form-control" id="" name="nomeSocial" value="{{ old('nomeSocial') }}" placeholder="Nome Social">
    			</div>
    			<div class="form-group">
    				<label for="">Nome Artístico</label>
    				<input type="text" class="form-control" id="" name="nomeArtistico" value="{{ old('nomeArtistico') }}" placeholder="Nome Artístico">
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('rgRne') ? ' has-error' : '' }}">
    				<label for="">RG - RNE</label>
    				<input type="text" class="form-control" id="" name="rgRne" value="{{ old('rgRne') }}" placeholder="RG ou RNE">
    			</div>
    			<div class="form-group">
    				<label for="">Passaporte</label>
    				<input type="text" class="form-control" id="" name="passaporte" value="{{ old('passaporte') }}" placeholder="Passaporte">
    			</div>
    			<div class="form-group">
    				<label for="">CPF</label>
    				<input type="text" class="form-control" id="" name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00">
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('dataNascimento') ? ' has-error' : '' }}">
    				<label for="">Data de Nascimento</label>
    				<input type="date" class="form-control" id="" name="dataNascimento" value="{{ old('dataNascimento') }}" placeholder="01/01/1990">
    			</div>
    			<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
	    			<label for="email">E-mail</label>
	    			<div class="input-group">
	    				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	    				<input type="email" class="form-control" name="email" placeholder='example@email.com'>
	    			</div>
	    		</div>
    			<div class="form-group has-feedback {{ $errors->has('documento') ? ' has-error' : '' }}">
    				<label for="">Documento?</label>
    				<input type="file" name="documento" id="">

    				<p class="help-block">Arquivo de até 3 megas</p>
    			</div>

    		</div>

    		<div class="box-footer">
    			<button type="submit" class="btn btn-primary">Cadastrar</button>
    		</div>
    	</form>
    </div>
    	
@stop