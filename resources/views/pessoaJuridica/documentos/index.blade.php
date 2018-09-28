@extends('adminlte::page')

@section('title', 'Documentos Pessoa Física')

@section('content_header')
    
@stop

@section('content')	
 
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Quick Example</h3>
    </div>

    <form role="form" method="POST" action="{{ route('pessoaJuridica.upload') }}">
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" name="cpf">
                @csrf
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
  </div>
@stop

@section('js')

@stop

