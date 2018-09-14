@extends('adminlte::page')

@section('title', 'Cadastro Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
			<h3 class="box-title">1º Representante Legal</h3><br>
		</div>

		@if (isset($rep2))
			<div class="box-footer">
				<button class="btn btn-warning" data-toggle="modal" data-target="#trocar"><i class="glyphicon glyphicon-sort"></i> 
					Trocar Representante
				</button>
			</div>

			<div class="modal fade" id="trocar" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Trocar Representante Legal?</h4>
						</div>
						<div class="modal-body">
							<p>Você tem a opção de vincular o(a) representante {{ $rep2->nome }}, como 1º representante Legal!</p>				
							<p>Deseja Realizar a troca?</p>
						</div>
						<div class="modal-footer">
							<form method="POST" action="{{route('pessoaJuridica.removerRepresentante')}}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>					
								<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
								Sim
								</button>      
							</form>
						</div>
					</div>
				</div>
			</div>
			
		@endif
		
		<form method="POST" class="form form-inline" action="{{ route('pessoaJuridica.search') }}">
			{{ csrf_field() }}
			<div class="box-body">
				<p class="form-block">
					<label>Pesquisar Representante Pelo CPF</label>
				</p>
				<input type="text" name="cpf" id="CPF" value="{{ old('cpf') }}" class="form-control" placeholder="CPF" title="Pesquisar CPF Representante Legal">
				<button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</form>
		
		@if (isset($rep) || isset($cpf) || old('nome') || old('rg') )

			
			<form role="form" id="formRep" method="post" action="{{ route('pessoaJuridica.cadastroRepresentante') }}">
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
						<input type="text" class="form-control" name="cpf" id="CPF" value="{{  old('cpf') }}" placeholder="CPF" disabled>
					</div>
				</div>

				<div class="box-footer">
					<button id="btn" type="submit" class="btn btn-primary">Cadastrar Representante Legal</button>
				</div>
			</form>

		@endif
    </div>
    
@stop

@section('js')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
	<script>
			let form 	= document.querySelector("#formRep");
			let inputId = document.createElement("input");
			let cpf 	= document.querySelector("#formRep input[name='cpf']");
			let nome 	= document.querySelector("#formRep input[name='nome']");
			let rg 		= document.querySelector("#formRep input[name='rg']");
			let btn 	= document.querySelector("#btn");
	</script>	
		@if(isset($rep))
			<script>
				btn.innerHTML 	= "Vincular Representante";
				form.action 	= "{{ route('pessoaJuridica.vincularRepresentante') }}";
				nome.value 		= '{{ $rep->nome}}';
				rg.value 		= '{{ $rep->rg }}';
				cpf.value 		= '{{ $rep->cpf }}';

				// cpf.setAttribute("disabled", true);

				inputId.type 	= "hidden";
				inputId.setAttribute('name', 'id');
				inputId.value 	= '{{ $rep->id }}';	
				form.insertBefore(inputId, form.firstChild);
			</script>		
		@endif

		@if (isset($cpf))
			<script>
				cpf.value 		= '{{ $cpf }}';
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
