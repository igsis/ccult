@extends('adminlte::page')

@section('title', 'Cadastro Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Representante Legal</h3>
    	</div>

    	<form role="form" method="post" action="{{route('pessoaJuridica.cadastroRepresentante2')}}">
    		{{ csrf_field() }}
    		<div class="box-body">
    			<div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
    				<label for="">Nome</label>
    				<input type="text" class="form-control" id="" name="nome" value="{{ $rep->nome }}" placeholder="Nome">
    			</div>
    			
    			<div class="form-group has-feedback {{ $errors->has('rg') ? ' has-error' : '' }}">
    				<label for="">RG</label>
    				<input type="text" class="form-control" name="rg" value="{{ $rep->rg }}" placeholder="RG">
    			</div>
    			<div class="form-group">
    				<label for="">CPF</label>
    				<input type="text" class="form-control" id="CPF" value="{{ $rep->cpf }}" disabled>
    			</div>
    		</div>

    		<div class="box-footer">
    			<button type="submit" class="btn btn-primary">Cadastrar Representante Legal</button>
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
