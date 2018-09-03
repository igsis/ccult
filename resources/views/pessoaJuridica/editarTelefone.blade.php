
@extends('adminlte::page')

@section('title', 'Endereço')


@section('content_header')
    <!-- <h1>Telefones </h1> -->
@stop

@section('content')

     <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Telefones</h3>
    	</div>

    	<form role="form" method="post" action="{{ route('pessoaJuridica.atualizaTelefone') }}">
    		{{ csrf_field() }}
    		<div class="box-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" data-mask="(00) 0000-0000"  placeholder="(11) xxxx-xxxx" value="{{ $tel->telefone }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefone">Celular</label>
                        <input type="text" class="form-control" name="celular" id="telefone" data-mask="(00) 00000-0000" placeholder="(11) xxxx-xxxx" value="{{ $tel->celular }}">
                    </div>
                </div>  
			

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Atualizar Telefone</button>
                </div>
            </div>
    	</form>
    </div>

@stop

@section('js')
    @include('scripts.busca_cep')
    <script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
@stop

        
