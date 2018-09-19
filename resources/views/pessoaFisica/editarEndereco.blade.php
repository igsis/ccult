
@extends('adminlte::page')

@section('title', 'Telefones')


@section('content_header')
    <!-- <h1>Endereço </h1> -->
@stop

@section('content')

     <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Telefones</h3>
    	</div>

    	<form role="form" method="post" action="{{route('pessoaFisica.atualizarEndereco')}}">
    		{{ csrf_field() }}
    		<div class="box-body">
                <div class="row">
                    <div class="form-group col-md-2 has-feedback {{ $errors->has('cep') ? ' has-error' : '' }}">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000" placeholder="xxxxx-xxx" value="{{ $endereco->cep }}">
                    </div>
                    <div class="form-group col-md-10">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" name="logradouro" id="logradouro" readonly value="{{ $endereco->logradouro }}">
                    </div>
                </div>  
                <div class="row">           
                    <div class="form-group col-md-2 has-feedback {{ $errors->has('numero') ? ' has-error' : '' }}">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero" value="{{ $endereco->numero }}">
                    </div>

                    <div class="form-group col-md-3 has-feedback {{ $errors->has('complemento') ? ' has-error' : '' }}">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="complemento" value="{{ $endereco->complemento }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" readonly value="{{ $endereco->bairro }}">
                    </div>            

                    <div class="form-group col-md-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" readonly value="{{ $endereco->cidade }}">
                    </div>

                    <div class="form-group col-md-1">
                        <label for="uf">UF</label>
                        <input type="text" class="form-control" name="uf" id="uf" readonly value="{{ $endereco->uf }}">
                    </div>
                </div>  			

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Atualizar Endereço</button>
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

        
