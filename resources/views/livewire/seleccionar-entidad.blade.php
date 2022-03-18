<div class="row col-md-6">
    <div class="col-md-6 col-sm-6 my-3">
        <div class="form-group">
            {{ Form::label('Tipo de Entidad:', null, ['class' => 'control-label']) }}
            <div class="input-group">
                {{-- @if (!is_null($tipo))
                {!! Form::select('tipo_entidad', $tipo_entidades, $tipo, ['placeholder' => 'Seleccione...',
                                                                         'class'=>'form-control',
                                                                         'wire:model'=>'selectTipo']) !!}
                @else --}}
                {!! Form::select('tipo_entidad', $tipo_entidades, $selecttipo, array_merge(['class' => 'form-control'], 
                                                            (is_null($selecttipo))?['placeholder'=>'Seleccione...']:[''],
                                                                                    ['wire:model'=>'selecttipo'], 
                                                                                    ['tabindex'=>'7'])) !!}
                {{-- @endif --}}
            </div>
            @error('tipo_entidad')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6 col-sm-6 my-3">
        <div class="form-group">
            {{ Form::label('Entidad:', null, ['class' => 'control-label']) }}
            <div class="input-group">
                {!! Form::select('entidad', (!is_null($entidades))?$entidades:['0'=>'Seleccione...'],$selectentidad , 
                                                                array_merge(['class' => 'form-control'], 
                                                                (!is_null($entidades))?['placeholder'=>'Seleccione...']:[''], ['required'],
                                                                            ['tabindex'=>'8'])) !!}
            </div>
            @error('entidad')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>