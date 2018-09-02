@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>You are logged in pj</p>
    {{auth()->user()->email}}
@stop

