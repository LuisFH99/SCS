<div>
    <div class="card-body">
        <div class="input-group rounded col-6">
            <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>
    @if($encargados->count())
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th width="10px">N°</th>
                            <th>Entidad</th>
                            <th>tipo</th>
                            <th>encargado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $aux=1;
                        @endphp
                        @foreach($encargados as $encargado)
                        <tr>
                            <td>{{ $aux++; }}</td>
                            <td>{{ $encargado->nombre }}</td>
                            <td>{{ $encargado->tipo }}</td>
                            <td>{{ $encargado->nombres.' '.$encargado->apell_pat.' '.$encargado->apell_mat}}</td>
                            <td width="120px">
                                <a href="{{route('mostrarPDF',$encargado->entidad_id)}}" class="btn btn-dark btn-sm" onclick="imprimir({{$encargado->entidad_id}},1)">
                                    <i class="fas fa-fw fa-eye"></i>
                                    Descargar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$encargados->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay Registros</strong>
        </div>
    @endif
</div>
