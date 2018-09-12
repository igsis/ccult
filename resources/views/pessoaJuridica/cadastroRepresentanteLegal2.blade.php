@extends('adminlte::page')

@section('title', 'Cadastro Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">2º Representante Legal</h3>
    	</div>

    	<form role="form" id="formRep" method="post" action="{{route('pessoaJuridica.cadastroRepresentante2')}}">
    		{{ csrf_field() }}
    		<div class="box-body">
    			<div class="form-group has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
    				<label for="">Nome</label>
    				<input type="text" class="form-control" id="" name="nome" value="{{ old('nome') }}" placeholder="Nome">
    			</div>
    			
    			<div class="form-group has-feedback {{ $errors->has('rg') ? ' has-error' : '' }}">
    				<label for="">RG</label>
    				<input type="text" class="form-control" name="rg" value="{{ old('rg') }}" placeholder="RG">
    			</div>
    			<div class="form-group">
    				<label for="">CPF</label>
    				<input type="text" class="form-control" name="cpf" id="CPF" value="{{ old('cpf') }}" placeholder="CPF">
    			</div>
    		</div>

    		<div class="box-footer">
    			<button id="btn" type="submit" class="btn btn-primary">Cadastrar Representante Legal</button>
    		</div>
    	</form>
    </div>

@stop

@section('js')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>

	@if(isset($rep))
			<script>
				let form 	= document.querySelector("#formRep");
				let inputId = document.createElement("input");
				let cpf 	= document.querySelector("#formRep input[name='cpf']");
				let nome 	= document.querySelector("#formRep input[name='nome']");
				let rg 		= document.querySelector("#formRep input[name='rg']");
				let btn 	= document.querySelector("#btn");

				btn.innerHTML 	= "Vincular Representante";
				form.action 	= "{{route('pessoaJuridica.vincularRepresentante2')}}";
				nome.value 		= '{{$rep->nome}}';
				rg.value 		= '{{$rep->rg}}';
				cpf.value 		= '{{$rep->cpf}}';

				cpf.setAttribute("disabled", true);

				inputId.type 	= "hidden";
				inputId.setAttribute('name', 'id');
				inputId.value 	= '{{$rep->id}}';	
				form.insertBefore(inputId, form.firstChild);
			</script>		
		@endif

    <script>
        $(document).ready(function () { 
            let $seuCampoCpf = $("#CPF");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
			let $seuCampoCpf2 = $("#CPF2");
            $seuCampoCpf2.mask('000.000.000-00', {reverse: true});
        });
    </script>
@stop
