@extends('adminlte::page')

@section('title', 'Pesquisar Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
			<h3 class="box-title">2º Representante Legal</h3><br>
        </div>
       
        
        <form method="POST" class="form form-inline" action="{{ route('pessoaJuridica.search2') }}">
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
        });
    </script>
@stop

















