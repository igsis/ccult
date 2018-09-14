@extends('adminlte::page')

@section('title', 'Pesquisar Representante Legal')

@section('content_header')
    
@stop

@section('content')	
 
    <div class="box box-primary">
    	<div class="box-header with-border">
			<h3 class="box-title">1º Representante Legal</h3><br>
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
			let $seuCampoCpf2 = $("#CPF2");
            $seuCampoCpf2.mask('000.000.000-00', {reverse: true});
        });
    </script>
@stop

















