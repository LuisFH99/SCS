@extends('adminlte::page')

@section('title', 'Ver de Usuarios')

@section('content_header')
    <h1>Ver Usuarios</h1>
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
            <li class="breadcrumb-item active">Ver</li>
        </ol>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    Ver Usuario
                </div>
                <div class="card-body">
                    <p>
                        <strong>Nombre: </strong> {{ $user->name }}
                    </p>
                    <p>
                        <strong>DNI: </strong> {{ $encargado->DNI }}
                    </p>
                    <p>
                        <strong>Email: </strong> {{ $user->email }}
                    </p>
                    <p>
                        Encargado de la <strong>{{ $encargado->tipo }}</strong> de <strong>{{ $encargado->nombre }}</strong> 
                    </p>
                    <p>
                        <strong>Roles: </strong> @foreach ($roles as $role ) {{' '.$role}}@endforeach
                    </p>
                </div>
                <div class="text-right p-0 pr-3 pb-3">
                    <a href="{{ route('users.index') }}" class="btn btn-danger">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Retornar
                    </a>
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
@stop

@section('js')
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @toastr_js
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
@stop