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
    @if($users->count())
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
                        
                        @foreach($users as $user)
                        <tr>
                            <td class="align-V">{{ $user->contador }}</td>
                            <td class="align-V">{{ $user->DNI }}</td>
                            <td class="align-V">{{ $user->nombres.' '.$user->apell_pat.' '.$user->apell_mat }}</td>
                            <td class="align-V">{{ $user->correo }}</td>
                            <td class="align-V">{{ $user->telefono }}</td>
                            <td class="align-V">{{ $user->tipo }}</td>
                            <td class="align-V">{{ $user->nombre }}</td>
                            <td class="align-V"><span class="badge {{($user->activo ==1 )?'bg-success':'bg-danger'}}">{{($user->activo ==1 )?'Habilitado':'Deshabilitado'}}</span></td>
                            <td class="align-V">
                                <a class="btn btn-warning btn-sm" href="#" onclick="habilitar({{$user->id}},{{$user->activo}})" 
                                        title="{{($user->activo ==1 )?'Deshabilitar':'Habilitar'}} Usuario">
                                    <i class="fas fa-arrow-alt-circle-{{($user->activo ==1 )?'down':'up'}} whiterr"></i>
                                </a>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-dark btn-sm" title="Ver Usuario">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-fw fa-edit"></i>
                                    Editar
                                </a>
                                <button id="{{ $user->id }}" class="delete-button btn btn-danger btn-sm">
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
            {{$users->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay Registros</strong>
        </div>
    @endif
</div>
