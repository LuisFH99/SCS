@extends('adminlte::page')

@section('title', 'Requerimiento')


@section('content')
    <livewire:dependencias />
@stop

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/cute-alert.js') }}"></script>
@stop
