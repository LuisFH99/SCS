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
                            <th width="320px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->contador }}</td>
                            <td>{{ $user->DNI }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telefono }}</td>
                            <td>{{ $user->tipo }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-dark">
                                    <i class="fas fa-fw fa-eye"></i>
                                    Ver
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                    <i class="fas fa-fw fa-edit"></i>
                                    Editar
                                </a>
                                <button id="{{ $user->id }}" class="delete-button btn btn-danger">
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
