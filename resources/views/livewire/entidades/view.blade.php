<div class="row">

    @foreach ($entidades as $entidad)
        <div class="col-12 my-2">
            <h2 class="text-center text-uppercase">{{ $entidad->nombre }}</h2>
        </div>

        @foreach ($entidad->subentidades as $subentidad)
            <div class="col-md-4 mb-2">
                <div class="card h-100 border-success rounded shadow">
                    <div class="card-header bg-transparent">
                        <div class="col-md-12 d-flex justify-content-end">
                            <span class="badge {{ $subentidad->estado == '0' ? 'bg-danger' : 'bg-success' }}">{{ $subentidad->estado == '0' ? 'Pendiente' : 'Registrado' }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="font-weight-bold text-center text-uppercase">{{ $subentidad->nombre }}</h5>
                    </div>
                    <div class="card-footer ">
                        <center><a href="{{ route('requerimiento.index', $subentidad->id) }}" class="text-primary"><i
                                    class="fas fa-clipboard-list mr-1"></i><strong>Registrar</strong></a></center>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

</div>
