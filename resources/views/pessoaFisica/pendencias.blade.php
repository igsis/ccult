@extends('adminlte::page')

@section('title', 'CCULT - PENDÊNCIAS')

@section('content_header')
    <h1>Pendências</h1>
@stop

@section('content')
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et odio optio obcaecati iste 
        repellendus minima odit sit, fuga amet natus fugit accusantium ipsum, sapiente ad rem c
        ulpa corrupti cumque temporibus?</p>

    <div class="box-body">
        @foreach($notificacoes as $notificacao)
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> {{ $notificacao->titulo  }}!</h4>
                {{ $notificacao->aviso}}
                <p class="text-right"><a href="{{ $notificacao->rota }}">Clique Para Cadastrar</a></p> 
            </div>
        @endforeach
    </div>
@stop