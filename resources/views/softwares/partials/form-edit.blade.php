<div class="col-md-6 col-sm-6">
	<div class="form-group">
		{{ Form::label('TIPO DE SOFTWARE:', null, ['class' => 'control-label d-flex']) }}
		{!! Form::select('tipoSofware',['1' => 'Predeterminado', '2' => 'Especializado'], $software->tipo, array_merge(['class' => 'form-control d-flex'], 
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
			{{ Form::text('nombre', $software->nombre, array_merge(['class' => 'form-control'], 
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
			{{ Form::text('anio', $software->año, array_merge(['class' => 'form-control'], 
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
			{{ Form::text('version', $software->version, array_merge(['class' => 'form-control'], 
													  ['placeholder'=>'Ingrese Versión'], 
													  ['tabindex'=>'3'])) }}
			@error('version')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="{{($software->tipo==1)?'d-flex':'d-none'}}" id="divPrecio">
			<div class="form-group">
				{{ Form::label('Precio:', null, ['class' => 'control-label']) }}
				{{ Form::text('precio', $software->precio_referencial, 
												array_merge(['class' => 'form-control'], 
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
			@if ($software->tipo==2)
				<select  name="tipoLicencia[]" id="tipoLicencia[]" class="js-example-basic-multiple form-control" multiple='multiple'>
					@foreach ($tipos as $tipo)
						<option value="{{$tipo->id}}" @foreach ($dTipoLics as $dTipoLic)
							@if ($dTipoLic->tipo_licencia_id==$tipo->id)
								selected="selected" @endif @endforeach>{{$tipo->tipo}}</option>
					@endforeach
				</select>
			@endif
			@if ($software->tipo==1)
				{!! Form::select("tipoLicencia[]", $tipos, $software->tipo_licencia_id, ['class' => 'js-example-basic-multiple form-control',
															  						 'multiple'=>'multiple']) !!}
			@endif
			@error('tipoLicencia')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-6 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Periodo:', null, ['class' => 'control-label']) }}
			@if ($software->tipo==2)
				<select  name="tipoPeriodo[]" id="tipoPeriodo[]" class="js-example-basic-multiple1 form-control" multiple='multiple'>
					@foreach ($periodos as $periodo)
						<option value="{{$periodo->id}}" @foreach ($dPeriodos as $dPeriodo)
							@if ($dPeriodo->periodo_id==$periodo->id)
								selected="selected" @endif @endforeach>{{$periodo->periodo}}</option>
					@endforeach
				</select>
			@endif
			@if ($software->tipo==1)
				{!! Form::select("tipoPeriodo[]", $periodos, $software->periodo_id, ['class' => 'js-example-basic-multiple1 form-control',
																					 'multiple'=>'multiple']) !!}
			@endif
			
			
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