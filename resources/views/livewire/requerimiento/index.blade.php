@extends('adminlte::page')

@section('title', 'Requerimiento')


@section('content')
<div class="row">
    <div class="col-12 content-header">
        <div class="container-fluid">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Dependencias
                    </a>
                </li>
                <li class="breadcrumb-item active">Registrar</li>
            </ol>
        </div>
    </div>

</div>
    
    <livewire:requerimiento />
@stop

@section('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/cute-alert.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            Livewire.on('confirmEliminarArea', areaId=>{
                cuteAlert({
                type: "question",
                title: "Mensaje de Sistema",
                img: "question.svg",
                message: "¿Esta seguro de eliminar el area?",
                confirmText: "SI",
                cancelText: "NO"
                }).then((e)=>{
                    console.log(e)
                if ( e == ("confirm")){
                    Livewire.emitTo('requerimiento','eliminararea',areaId)
                } else {
                    console.log('No confirmo');
                }
                })
            });
            Livewire.on('confirmEliminarSoftware', softwareId=>{
                cuteAlert({
                type: "question",
                title: "Mensaje de Sistema",
                img: "question.svg",
                message: "¿Esta seguro de eliminar el software del requerimiento?",
                confirmText: "SI",
                cancelText: "NO"
                }).then((e)=>{
                    console.log(e)
                if ( e == ("confirm")){
                    Livewire.emitTo('requerimiento','eliminarsoftware',softwareId)
                } else {
                    console.log('No confirmo');
                }
                })
            });
        });
        function SoloNumeros(e) {
           var key = Window.Event ? e.which : e.keyCode;
           if (key < 48 || key > 57) {

               e.preventDefault();
           }
       }
   </script>
@stop
