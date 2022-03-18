<div class="form-row">
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('DNI:', null, ['class' => 'control-label']) }}
			{{ Form::text('DNI', $encargado->DNI, array_merge(['class' => 'form-control'], 
												   ['placeholder'=>'Ingrese el N° DNI',
													'maxlength'=>'8',
													'onkeypress'=>'return SoloNumeros(event)',
													'tabindex'=>'1'])) }}
			@error('DNI')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> 
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Apellido Paterno:', null, ['class' => 'control-label']) }}
			{{ Form::text('apell_pat', $encargado->apell_pat, array_merge(['class' => 'form-contro'], 
													  ['placeholder'=>'Ingrese Apellido Paterno'], 
													  ['tabindex'=>'2'])) }}
			@error('apell_pat')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Apellido Materno:', null, ['class' => 'control-label']) }}
			{{ Form::text('apell_mat', $encargado->apell_mat, array_merge(['class' => 'form-control select2'], 
													  ['placeholder'=>'Ingrese Apellido Materno'], 
													  ['tabindex'=>'3'])) }}
			@error('apell_mat')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Nombres:', null, ['class' => 'control-label']) }}
			{{ Form::text('nombres', $encargado->nombres, array_merge(['class' => 'form-control'], 
													   ['placeholder'=>'Ingrese Nombres'], 
													   ['tabindex'=>'4'])) }}
			@error('nombres')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Celular:', null, ['class' => 'control-label']) }}
			{{ Form::text('telefono', $encargado->telefono, array_merge(['class' => 'form-control'], 
														['placeholder'=>'Ingrese el N° Celular','maxlength'=>'9',
														 'onkeypress'=>'return SoloNumeros(event)','tabindex'=>'5'])) }}
			@error('telefono')
				<small class="text-danger">{{$message}}</small>
			@enderror
	</div>
	</div>
	<div class="col-md-3 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Correo:', null, ['class' => 'control-label']) }}
			{{ Form::email('correo', $encargado->correo, array_merge(['class' => 'form-control'], 
													   ['placeholder'=>'correo@unasam.edu.pe','tabindex'=>'6'])) }}
		
			@error('correo')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6 my-3">
        <div class="form-group">
            {{ Form::label('Entidad:', null, ['class' => 'control-label']) }}
            <div class="input-group">
                <select name="entidad" id="entidad" class="form-control js-example-basic-single" placeholder="Seleccionar..." required>
					@foreach ($tipo as $item)
						<optgroup label="{{$item->tipo}}">
							@foreach ($entidades1 as $entidad1)
								@if ($entidad1->idt==$item->id)
									<option value="{{$entidad1->id}}" @if ($encargado->entidad_id==$entidad1->id)
										selected										
									@endif>{{$entidad1->nombre}}</option>
								@endif
							@endforeach
						</optgroup>
					@endforeach
				</select>
            </div>
            @error('entidad')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
	
</div>
<hr>
<h3>Lista de roles</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $role)
		<li>
			<label>
				{{ Form::checkbox('roles[]', $role->id, null) }}
				{{ $role->name }}
				<em>({{ $role->description ?: 'Sin descripción' }})</em>
			</label>
		</li>
		@endforeach
	</ul>
</div>
<div class="form-group">
	{{ Form::button('<i class="fa fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
    <a href="{{ route('users.index') }}" class="btn btn-danger">
        <i class="fas fa-fw fa-arrow-left"></i>
        Retornar
    </a>
</div>