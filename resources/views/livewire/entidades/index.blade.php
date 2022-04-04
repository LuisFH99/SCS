@extends('adminlte::page')

@section('title', 'Requerimiento')


@section('content')
    <livewire:entidades />
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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@stop

@section('js')
    <script src="{{ asset('js/cute-alert.js') }}"></script>
    <script>
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
