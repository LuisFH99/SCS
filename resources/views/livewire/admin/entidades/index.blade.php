@extends('adminlte::page')

@section('title', 'ListaEntidades')


@section('content')
<div class="d-flex justify-content-center ">
    <h3 class="font-weight-bold mt-2 ">CONTROL DE ENTIDADES</h3>
</div>
    
    <livewire:admin.entidades-admin />
@stop

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/cute-alert.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Livewire.on('confirmCambioEstado', subentidadId=>{
                cuteAlert({
                type: "question",
                title: "Mensaje de Sistema",
                img: "question.svg",
                message: "¿Esta seguro de Cambiar de Estado...?",
                confirmText: "SI",
                cancelText: "NO"
                }).then((e)=>{
                    console.log(e)
                if ( e == ("confirm")){
                    Livewire.emitTo('admin.entidades-admin','cambiarestado',subentidadId)
                } else {
                    console.log('No confirmo');
                }
                })
            });
        });
    </script>
@stop
