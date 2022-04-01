<div class="col-md-6 col-sm-6">
	<div class="form-group">
		{{ Form::label('TIPO DE SOFTWARE:', null, ['class' => 'control-label d-flex']) }}
		{!! Form::select('tipoSofware',['1' => 'Predeterminado', '2' => 'Especializado'], '2', array_merge(['class' => 'form-control d-flex'], 
																   ['placeholder'=>'Seleccione...','onChange'=>'mostrarPrecio(this.value);',
																	'onselect'=>'mostrarPrecio(this.value);',
																	'tabindex'=>'5'])) !!}
	</div>
</div>
<hr>
<div class="form-row">
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('nombre:', null, ['class' => 'control-label']) }}
			{{ Form::text('nombre', null, array_merge(['class' => 'form-control'], 
												   ['placeholder'=>'Ingrese el Nombre',
													'tabindex'=>'1'])) }}
			@error('nombre')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div> 
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Año:', null, ['class' => 'control-label']) }}
			{{ Form::text('anio', null, array_merge(['class' => 'form-control'], 
													  ['placeholder'=>'Ingrese Año'],['maxlength'=>'4'],
													  ['onkeypress'=>'return SoloNumeros(event)'],
													  ['tabindex'=>'2'])) }}
			@error('anio')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			{{ Form::label('Versión:', null, ['class' => 'control-label']) }}
			{{ Form::text('version', null, array_merge(['class' => 'form-control'], 
													  ['placeholder'=>'Ingrese Versión'], 
													  ['tabindex'=>'3'])) }}
			@error('version')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="d-none" id="divPrecio">
			<div class="form-group">
				{{ Form::label('Precio:', null, ['class' => 'control-label']) }}
				{{ Form::text('precio', '0.00', array_merge(['class' => 'form-control'], 
														   ['placeholder'=>'Ingrese Precio'], 
														   ['tabindex'=>'4'])) }}
				@error('precio')
					<small class="text-danger">{{$message}}</small>
				@enderror
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Licencia:', null, ['class' => 'control-label']) }}
			{!! Form::select("tipoLicencia[]", $tipos, null, ['class' => 'js-example-basic-multiple form-control',
															  'multiple'=>'multiple']) !!}
			@error('tipoLicencia')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-6 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Periodo:', null, ['class' => 'control-label']) }}
			{!! Form::select("tipoPeriodo[]", $periodos, null, ['class' => 'js-example-basic-multiple form-control',
															  'multiple'=>'multiple']) !!}
			@error('tipoPeriodo')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
</div>
<hr>
<div class="form-group">
	{{ Form::button('<i class="fa fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
    <a href="{{ route('softwares.index') }}" class="btn btn-danger">
        <i class="fas fa-fw fa-arrow-left"></i>
        Retornar
    </a>
</div>