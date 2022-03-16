<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-11 my-2">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                aria-selected="true">
                                <h5>Identificacion</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="false">
                                <h5>Software</h5>
                            </a>
                        </li>
                    </ul>

                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            @include('livewire.requerimiento.create')

                            <div class="col-12">
                                @if (count($areas)>0)
                                    <div class="row">
                                        @foreach ($areas as $area)
                                            <div class="col-md-4">
                                                <label class="form-label">Nombre:</label>
                                                <input type="text" placeholder="Ingresar Dato" class="form-control" value="{{$area->codigo}}">
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Numero de PC's:</label>
                                                <input type="text" placeholder="Igrese Dato" class="form-control" value="{{$area->num_pc}}">
                                            </div>
                                            <div class="col-md-3">
                                                <button class="btn btn-outline-danger" type="button" wire:click="deleteArea({{ $area->id }})"
                                                    style="margin-top: 30px;"><i class="fas fa-trash"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                <div class="alert" style="background: #ffd451" role="alert">
                                    <strong>Actualmente no hay registros</strong>   
                                  </div>
                                    
                                @endif
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        @include('livewire.requerimiento.registersoftware')
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead class="bg-olive">
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Nombre</th>
                                                        <th>Año</th>
                                                        <th>Version</th>
                                                        <th>Caracteristicas</th>
                                                        <th>Tipo Licencia</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $num=1;
                                                    @endphp
                                                    @foreach ($sftespecializado as $software)
                                                    <tr>
                                                        <td>{{$num++}}.</td>
                                                        <td>{{$software->nombre}}</td>
                                                        <td>{{$software->año}}</td>
                                                        <td>{{$software->version}}</td>
                                                        <td>{{$software->caracteristicas}}</td>
                                                        <td>{{$software->tiposoftware->tipo}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-info">
                                            <h3 class="card-title"><i class="fas fa-list-ol mr-1"></i>
                                                <b>Requerimientos</b> </h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead class="bg-olive">
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Descripcion</th>
                                                        <th style="width: 80px;">Cantidad</th>
                                                        <th style="width: 150px;">Precio Referencial</th>
                                                        <th style="width: 150px;">Sub total (S/.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $num=1;
                                                    @endphp
                                                    @foreach ($sftpredeterminado as $item)
                                                    
                                                    <tr>
                                                        <td>{{$num++}}.</td>
                                                        <td>{{$item->nombre}}</td>
                                                        <td>{{$totalpc}}</td>
                                                        <td>S/ {{$item->precio_referencial}}</td>
                                                        <td>S/ {{$totalpc*$item->precio_referencial}}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </div>

</div>
<script>
    window.onload = function() {
        miNotificacion();
    }
</script>
