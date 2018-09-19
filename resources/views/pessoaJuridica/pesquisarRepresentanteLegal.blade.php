@extends('adminlte::page')

@section('title', 'Pesquisar Representante Legal')

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
							<form method="POST" action="{{ route('pessoaJuridica.trocarRepLegal') }}">
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
    </div>
    
@stop

@section('js')  
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    		
    <script>
        $(document).ready(function () { 
            let $seuCampoCpf = $("#CPF");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
			let $seuCampoCpf2 = $("#CPF2");
            $seuCampoCpf2.mask('000.000.000-00', {reverse: true});
        });
    </script>
@stop

















