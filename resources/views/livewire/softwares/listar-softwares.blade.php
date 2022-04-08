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
    @if($softwares->count())
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table">
                    <thead class="table-dark">
                        <tr>
                            <th width="10px">N°</th>
                            <th>Nombre</th>
                            <th>Año</th>
                            <th>Versión</th>
                            <th>Precio</th>
                            <th>Licencias</th>
                            <th>Periodos</th>
                            <th>Tipo</th>
                            <th width="240px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $aux=1;
                        @endphp
                        @foreach($softwares as $software)
                            <tr>
                                <td class="text-center align-V">{{ $software->contador}}</td>
                                <td class="align-V">{{ $software->nombre }}</td>
                                <td class="text-center align-V">{{ $software->año }}</td>
                                <td class="text-center align-V">{{ $software->version }}</td>
                                <td class="text-center align-V">{{ $software->precio_referencial }}</td>
                                @if ($software->tipo=='Predeterminado')
                                    <td class="text-center align-V">{{ $software->tipo_licencia_id }}</td>
                                    <td class="text-center align-V">{{ $software->periodo_id }}</td>
                                @else
                                    <td colspan="2">
                                        @livewire('softwares.listar-tipos', ['sft' => $software->id], key($software->id))
                                    </td>
                                @endif
                                <td class="text-center align-V">{{ $software->tipo }}</td>
                                <td class="text-center align-V">
                                    <a href="{{ route('softwares.edit1', ['software' => $software->id,'tipo' => $software->tipo]) }}" class="btn btn-primary">
                                        <i class="fas fa-fw fa-edit"></i>
                                        Editar
                                    </a>
                                    <button id="{{ $software->id.'-'.$software->tipo }}" class="delete-button btn btn-danger">
                                        <i class="fas fa-fw fa-trash"></i>
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$softwares->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay Registros</strong>
        </div>
    @endif
</div>