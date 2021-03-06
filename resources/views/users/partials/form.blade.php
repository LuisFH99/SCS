<div class="form-row">
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('DNI:', null, ['class' => 'control-label']) }}
			{{ Form::text('DNI', null, array_merge(['class' => 'form-control'], 
												   ['placeholder'=>'Ingrese el N° DNI',
													'maxlength'=>'8',
													'onkeypress'=>'return SoloNumeros(event)',
													'tabindex'=>'1'])) }}
			@error('DNI')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> 
	{{-- <div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Apellido Paterno:', null, ['class' => 'control-label']) }}
			{{ Form::text('apell_pat', null, array_merge(['class' => 'form-control'], 
													  ['placeholder'=>'Ingrese Apellido Paterno'], 
													  ['tabindex'=>'2'])) }}
			@error('apell_pat')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> --}}
	<div class="col-md-2 col-sm-6">
		<label class="form-label">Apellido Paterno:</label>
		<input type="text" id="apell_pat" name="apell_pat" class="form-control" placeholder="Ingrese Apellido Paterno" tabindex="2" value="{{ old('apell_pat') }}">
		@error('apell_pat')
			<small class="text-danger">{{$message}}</small>
		@enderror
	</div>
	{{-- <div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Apellido Materno:', null, ['class' => 'control-label']) }}
			{{ Form::text('apell_mat', null, array_merge(['class' => 'form-control'], 
													  ['placeholder'=>'Ingrese Apellido Materno'], 
													  ['tabindex'=>'3'])) }}
			@error('apell_mat')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> --}}
	<div class="col-md-2 col-sm-6">
		<label class="form-label">Apellido Materno:</label>
		<input type="text" id="apell_mat" name="apell_mat" class="form-control" placeholder="Ingrese Apellido Materno" tabindex="3" value="{{ old('apell_mat') }}">
		@error('apell_mat')
			<small class="text-danger">{{$message}}</small>
		@enderror
	</div>
	{{-- <div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Nombres:', null, ['class' => 'control-label']) }}
			{{ Form::text('nombres', null, array_merge(['class' => 'form-control'], 
													   ['placeholder'=>'Ingrese Nombres'], 
													   ['tabindex'=>'4'])) }}
			@error('nombres')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> --}}
	<div class="col-md-3 col-sm-6">
		<label class="form-label">Nombres:</label>
		<input type="text" id="nombres" name="nombres" class="form-control" placeholder="Ingrese Nombres" tabindex="4" value="{{ old('nombres') }}">
		@error('nombres')
			<small class="text-danger">{{$message}}</small>
		@enderror
		{{-- <div class="form-group">
			{{ Form::label('Nombres:', null, ['class' => 'control-label']) }}
			{{ Form::text('nombres', null, array_merge(['class' => 'form-control'], ['tabindex'=>'4'])) }}
		</div> --}}
	</div>
	<div class="col-md-3 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Celular:', null, ['class' => 'control-label']) }}
			{{ Form::text('telefono', null, array_merge(['class' => 'form-control'], 
														['placeholder'=>'Ingrese el N° Celular','maxlength'=>'9',
														 'onkeypress'=>'return SoloNumeros(event)','tabindex'=>'5'])) }}
			@error('telefono')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	{{-- <div class="col-md-3 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Correo:', null, ['class' => 'control-label']) }}
			{{ Form::email('correo', null, array_merge(['class' => 'form-control'], 
													   ['placeholder'=>'correo@unasam.edu.pe','tabindex'=>'6'])) }}
		
			@error('correo')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> --}}
	<div class="col-md-3 col-sm-6 my-3">
		<label class="form-label">Correo Institucional:</label>
		<input type="email" id="correo" name="correo" class="form-control" placeholder="correo@unasam.edu.pe" value="{{ old('email') }}"
			tabindex="7">
			@error('correo')
				<small class="text-danger">{{$message}}</small>
			@enderror
	</div>
	<div class="col-md-3 col-sm-6 my-3">
        <div class="form-group">
            {{ Form::label('Entidad:', null, ['class' => 'control-label']) }}
            <div class="form-group">
                <select name="entidad" id="entidad" class="js-example-basic-single form-control" required>
					@foreach ($tipo as $item)
						<optgroup label="{{$item->tipo}}">
							@foreach ($entidades1 as $entidad1)
								@if ($entidad1->idt==$item->id)
									<option value="{{$entidad1->id}}">{{$entidad1->nombre}}</option>
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
<div class="form-group">
	{{ Form::button('<i class="fa fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
    <a href="{{ route('users.index') }}" class="btn btn-danger">
        <i class="fas fa-fw fa-arrow-left"></i>
        Retornar
    </a>
</div> 