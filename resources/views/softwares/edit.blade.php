@extends('adminlte::page')

@section('title', 'Editar de Software')

@section('content_header')
    <h1>Editar Software</h1>
@stop

@section('content')
<div class="content">
    <div class="content-header">
      <div class="container-fluid">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('softwares.index') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    Lista de Softwares
                </a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    Editar Software
                </div>
                <div class="card-body">
                    {!! Form::model($software, ['route' => ['softwares.update', $software->id], 'method' => 'PUT']) !!}
                        @csrf
                        @include('softwares.partials.form-edit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('css')
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"/> --}}
    @toastr_css
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Seleccionar..."
            });
            $('.js-example-basic-multiple1').select2({
                placeholder: "Seleccionar..."
            });
        });
        function SoloNumeros(e){
            var key= Window.Event? e.which : e.keyCode;
            if (key < 48 || key > 57) { 
                e.preventDefault();
            }
        };
        function mostrarPrecio(id) {
            if(id==1){
                //aparecer
                $("#divPrecio").removeClass("d-none");
                $("#divPrecio").addClass("d-flex");
            }else{
                //desaparecer
                $("#divPrecio").removeClass("d-flex");
                $("#divPrecio").addClass("d-none");
            }
        }
    </script>
@stop
