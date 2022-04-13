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
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Entidad</th>
                            <th>Estado</th>
                            <th width="265px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($encargados as $encargado)
                        <tr>
                            <td class="align-V">{{ $encargado->contador }}</td>
                            <td class="align-V">{{ $encargado->DNI }}</td>
                            <td class="align-V">{{ $encargado->nombres.' '.$encargado->apell_pat.' '.$encargado->apell_mat }}</td>
                            <td class="align-V">{{ $encargado->correo }}</td>
                            <td class="align-V">{{ $encargado->telefono }}</td>
                            <td class="align-V">{{ $encargado->tipo }}</td>
                            <td class="align-V">{{ $encargado->nombre }}</td>
                            <td class="align-V"><span class="badge {{($encargado->activo ==1 )?'bg-success':'bg-danger'}}">{{($encargado->activo ==1 )?'Habilitado':'Deshabilitado'}}</span></td>
                            <td class="align-V">
                                <a class="btn btn-warning btn-sm" href="#" onclick="habilitar({{$encargado->id}},{{$encargado->activo}})" 
                                        title="{{($encargado->activo ==1 )?'Deshabilitar':'Habilitar'}} Usuario">
                                    <i class="fas fa-arrow-alt-circle-{{($encargado->activo ==1 )?'down':'up'}} whiterr"></i>
                                </a>
                                <a href="{{ route('users.show', $encargado->id) }}" class="btn btn-dark btn-sm" title="Ver Usuario">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $encargado->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-fw fa-edit"></i>
                                    Editar
                                </a>
                                <button id="{{ $encargado->id }}" class="delete-button btn btn-danger btn-sm">
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
            {{$encargados->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay Registros</strong>
        </div>
    @endif
</div>
