@extends('adminlte::page')

@section('title', 'Cadastro Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
			<h3 class="box-title">2º Representante Legal</h3><br>
		</div>
			
		<form role="form" id="formRep" method="post" action="{{ route('pessoaJuridica.cadastroRepresentante2') }}">
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
					<input type="text" class="form-control" name="cpf" id="CPF" value="{{  old('cpf') }}" placeholder="CPF">
				</div>
			</div>

			<div class="box-footer">
				<button id="btn" type="submit" class="btn btn-primary">Cadastrar Representante Legal</button>
				<a class="btn btn-info" href="{{ route('pessoaJuridica.formRepresentante2') }}"> Cadastrar Com Outro CPF </a>
			</div>
		</form>


    </div>
    
@stop

@section('js')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
	<script>
			let form 	= document.querySelector("#formRep");
			let cpf 	= document.querySelector("#formRep input[name='cpf']");
	</script>	

	@if (isset($cpf))
		<script>
			cpf.value 		= '{{ $cpf }}';
		</script>			
	@endif
		
    <script>
        $(document).ready(function () { 
            let $seuCampoCpf = $("#CPF");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
    </script>
@stop
