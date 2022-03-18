@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="content">
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    Lista de Usuarios
                    <a href="{{ route('users.create') }}" class="btn btn-success float-right">
                        <i class="fas fa-fw fa-save"></i>
                        Registrar
                    </a>
                </div>
                @livewire('user-index') 
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
    @toastr_render
    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            //delete method
            $(document).on('click', '.delete-button', function() {
                let csrf_token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Se eliminará al usuario y todo registro relacionado, esta operación no se podrá revertir!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
                }).then((result) => {
                if (result.value) {
                    let element = $(this)[0];
                    let id = $(element).attr('id');
                    $.ajax({
                        url: "{{ url('users') }}" + '/' + id,
                        type: "POST",
                        data: {'_method': 'DELETE', '_token': csrf_token},
                        success: function(data) {
                            alert(data);
                            location.reload();
                            //alert(data.id +' - '+ data.name +' - ' + data.email +' - ' + data.password );
                        },
                        error: function(data) {
                            Swal.fire({
                            type: 'error',
                            title: 'Hubo un error',
                            text: 'Intente recargar la página',
                            timer: 2000
                            });
                        }
                    });
                }
                });
            });
        });
    </script>
@stop