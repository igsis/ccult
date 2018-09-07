@extends('adminlte::page')

@section('title', 'Cadastro Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">2º Representante Legal</h3>
    	</div>

    	<form role="form" method="post" action="{{route('pessoaJuridica.editarRepresentante2')}}">
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
				<button type="submit" class="btn btn-primary">Atualizar 2º Representante Legal</button>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#desativar">
					Remover Representante Legal
				</button>
    		</div>
    	</form>
	</div>

	<div class="modal fade" id="desativar" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Desvincular {{$rep->nome}}?</h4>
			</div>
			<div class="modal-body">
				<p>Deseja desvincular o representante <b>{{$rep->nome}}</b> do seu cadastro? </p>
			</div>
			<div class="modal-footer">
				<form method="POST" action="{{route('pessoaJuridica.removerRepresentante2')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>					
					<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
					Desvincular
					</button>      
				</form>
			</div>
			</div>
		</div>
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
