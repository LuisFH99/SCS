@extends('adminlte::page')

@section('title', 'Registrar Software')

@section('content_header')
    <h1>Registrar Software</h1>
@stop

@section('content')
<div class="content">
    <div class="content-header">
      <div class="container-fluid">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('softwares.index') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    Lista de Software
                </a>
            </li>
            <li class="breadcrumb-item active">Registrar</li>
        </ol>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    Registrar Software
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'softwares.store','class'=>'needs-validation','novalidate']) !!}
                        @csrf
                        @include('softwares.partials.form-create')
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
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/style.css">
    @toastr_css
@stop

@section('js')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/cute-alert.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple1').select2({
                placeholder: "Seleccionar...",
                allowClear: true
            });
        });
    </script>
    <script src="{{ asset('js/softwares.js') }}"></script>
@stop

