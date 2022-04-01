<div id="accordion">
    <div class="form-group row ">
        <div class="input-group rounded col-md-9 mt-2">
            <label for="" class="col-md-3 col-form-label">Buscar
                Entidad:</label>
            <input type="search" wire:model="buscar"
                class="form-control rounded d-flex" placeholder="Buscar"
                aria-label="Search" aria-describedby="search-addon" />
            <div class="input-group-append">
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
            </div>
            </span>
        </div>
    </div>
    @if (count($entidades) > 0)
        @foreach ($entidades as $entidad)
            @php
                $total = $entidad->subentidades->count();
                $registrados = $entidad->subentidades->where('estado', '1')->count();
                if ($registrados > 0) {
                    $porcentaje = round(($registrados / $total) * 100);
                } else {
                    $porcentaje = 00;
                }
            @endphp
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title font-weight-bold text-uppercase mt-1">{{ $entidad->nombre }}</h3>
                        </div>
                        <div class="col-3">
                            <div class="progress progress-xs">
                                <div class="progress-bar {{$porcentaje<50 ? 'bg-danger' : ($porcentaje<90 ? 'bg-warning' : 'bg-primary')}}" style="width: {{$porcentaje}}%"></div>   
                            </div>
                            <small for="">Avance:  </small><span class="badge {{$porcentaje<50 ? 'bg-danger' : ($porcentaje<90 ? 'bg-warning' : 'bg-primary')}}">{{$porcentaje}}%</span>
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            {{-- <div class="card-tools "> --}}

                                {{-- <button type="button" class="btn btn-warning btn-sm">
                                    <i class="fas fa-user-plus"></i>
                                </button> --}}
            
                                <a data-toggle="collapse" href="#collapse{{ $entidad->id }}" class="btn btn-success btn-sm mr-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-info btn-sm" wire:click="enivarid({{$entidad->id}})">
                                    <i class="fas fa-clipboard-list"></i>
                                </a>
                                {{-- <button type="button" class="btn btn-info btn-sm">
                                    <i class="fas fa-clipboard-list"></i>
                                </button> --}}
            
                                {{-- <button type="button" class="btn btn-danger btn-sm" >
                                    <i class="fas fa-trash"></i>
                                </button> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
                <div id="collapse{{ $entidad->id }}" class="collapse" data-parent="#accordion">

                    <div class="card-body">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" style="vertical-align:middle; text-align: center;">#</th>
                                    <th scope="col" style="vertical-align:middle; text-align: center;">Nombre</th>
                                    <th scope="col" style="vertical-align:middle; text-align: center;">Estado</th>
                                    <th scope="col" style="width: 85px; vertical-align:middle; text-align: center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                {{-- @if ($entidad->subentidades) --}}
                                    @foreach ($entidad->subentidades as $subentidad)
                                        <tr>
                                            <th style="text-align: center;" scope="row">{{ $cont++ }}.</th>
                                            <td style="vertical-align: middle">{{ $subentidad->nombre }}</td>
                                            <td style="text-align: center;">
                                                <span class="badge {{ $subentidad->estado == '0' ? 'bg-danger' : 'bg-success' }}">{{ $subentidad->estado == '0' ? 'Pendiente' : 'Registrado' }}</span></td>
                                            <td style=" text-align: center;"><button type="button" class="btn btn-info btn-sm" wire:click="$emit('confirmCambioEstado',{{ $subentidad}})"><i class="fas fa-retweet"></i>
                                                </button></td>
                                        </tr>
                                    @endforeach
                                {{-- @else
                                    <tr>
                                    <td colspan="5">No hay registrados en la Lista</td>
                                    </tr>
                                @endif  --}}


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 d-flex justify-content-center">
            {{ $entidades->links() }}
        </div>
    @else
    <div class="d-flex justify-content-center">
        <div class="card col-7">
            <div class="card-header d-flex justify-content-center">
                <h3 class="card-title font-weight-bold "> NO SE ENCONTRA NINGUN REGISTRO EN EL SISTEMA</h3>
            </div>
        </div>
    </div>
    @endif
    
</div>

<script>
    window.onload = function() {
        miNotificacion();
    }
    function miNotificacion() {
        Livewire.on('alertaSistema', function(datos) {
            $(document).Toasts('create', {
                class: datos.modo,
                title: 'Mensaje de Sistema',
                body: datos.mensaje,
                autohide: true,
                delay: 950
            })
        });
    }
</script>

