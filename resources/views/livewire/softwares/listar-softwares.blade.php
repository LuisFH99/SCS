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
                            <th width="320px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $aux=1;
                        @endphp
                        <tr>hola</tr>
                        @foreach($softwares as $software)
                            <tr>
                                <td>{{ $aux++; }}</td>
                                <td>{{ $software->nombre }}</td>
                                <td>{{ $software->año }}</td>
                                <td>{{ $software->version }}</td>
                                <td>{{ $software->precio_referencial }}</td>
                                <td>Por definir</td>
                                <td>Por definir</td>
                                <td>{{ $software->tipo }}</td>
                                <td>
                                    <a href="{{ route('softwares.show', $software->id) }}" class="btn btn-dark">
                                        <i class="fas fa-fw fa-eye"></i>
                                        Ver
                                    </a>
                                    <a href="{{ route('softwares.edit', $software->id) }}" class="btn btn-primary">
                                        <i class="fas fa-fw fa-edit"></i>
                                        Editar
                                    </a>
                                    <button id="{{ $software->id }}" class="delete-button btn btn-danger">
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