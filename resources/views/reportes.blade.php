@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
<div class="content">
    <section class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-header">
                    Reporte General
                    <a href="{{route('ReportListSoftwares')}}" class="btn btn-primary float-right" onclick="imprimir(0,0)" target="_blank">
                        <i class="fa fa-file"></i>
                        Reporte General
                    </a>
                </div>
                @livewire('listar-entidades')
            </div>  
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg anch" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelPDF">Reporte de la ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="cerrar()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mostrarPDF" >   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary " data-dismiss="modal" onclick="cerrar()">Aceptar</button>
            </div>
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
    <script>
        $(document).ready(function() {

        });
        function imprimir(idE,tipo) {
            $.ajax({
                url: '/mostrarPDF',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    id: idE
                }
            }).done(function(dato) {
                console.log('correcto: '+ dato.entidad +' - '+ dato.url);
                selectId1(dato.entidad,tipo,dato.url);
            }).fail(function(msg) {
                console.log(msg);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salio mal!...'
                })
            });
        }
        function selectId1(entidad,tipo,url) {
        $('#labelPDF').html('Reporte'+((tipo==0)?' General':' de la '+entidad));
        $('#mostrarPDF').html("<embed src='" + url + "' frameborder='0'" +
            " width='100%' height='400px'>");
        $('#modalPDF').modal('show');
        }
        function cerrar() {

        $('#modalPDF').modal('hide');
        }
    </script>
@stop