@extends('adminlte::page')

@section('title', 'Ver Softwares')

@section('content_header')
    <h1>Ver Software</h1>
@stop

@section('content')
<div class="content">
    <div class="content-header">
      <div class="container-fluid">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{ route('softwares.index') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    Lista de SOftwares
                </a>
            </li>
            <li class="breadcrumb-item active">Ver</li>
        </ol>
      </div>
    </div>
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
@stop

@section('js')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
@stop