@extends('adminlte::page')

@section('title', 'Editar de Usuarios')

@section('content_header')
    <h1>Editar Usuarios</h1>
@stop

@section('content')
<div class="content">
    <div class="content-header">
      <div class="container-fluid">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    Lista de Usuarios
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
                    Editar Usuario
                </div>
                <div class="card-body">
                    {!! Form::model($encargado, ['route' => ['users.update', $encargado->id], 'method' => 'PUT']) !!}
                        @csrf
                        @include('users.partials.form-edit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet"/> --}}
    @toastr_css
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('#correo').focus(function() {
                $(this).val("" + generaremail($('#nombres').val().trim(), $('#apell_pat').val().trim().replace(/ /g, ""), 
                    $('#apell_mat').val().trim()));
            });
        });
        function SoloNumeros(e){
            var key= Window.Event? e.which : e.keyCode;
            if (key < 48 || key > 57) { 
                e.preventDefault();
            }
        }; 
        function generaremail(nom, ap, am) {
            let dto = nom.charAt(0).replace('??', 'n') + ap.replace('??', 'n') + am.charAt(0).replace('??', 'n') + "@unasam.edu.pe";
            return dto.toLowerCase();
        }

        function selecNombre(nombre){
            document.getElementById('exampleModalLabel').innerHTML=""+nombre;
        }
        function generaremail1() {
            let nom=$.trim($('#nombres').val());
            let ap=$.trim($('#apepat'));
            let am=$.trim($('#apemat'));
            let dto = ""+nom.charAt(0) + ap + am.charAt(0) + "@unasam.edu.pe";
            $('#email').val(dto.toLowerCase());
        }
    </script>
@stop
