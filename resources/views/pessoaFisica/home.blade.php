@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1>Bem vindo, {{auth()->user()->nome}}! </h1>
@stop

@section('content')
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Possimus velit architecto illo optio eum, provident voluptatem asperiores 
        voluptates saepe ipsam repellendus consequatur 
        similique aspernatur nisi amet, accusamus corporis deserunt.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit.  
        Libero, minus id nihil eius amet saepe accusamus nam dolores aliquam!
    </p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        Possimus velit architecto illo optio eum, provident voluptatem asperiores 
        voluptates saepe ipsam repellendus consequatur 
    </p>

@stop

