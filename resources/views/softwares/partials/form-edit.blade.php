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
	<div class="col-md-5 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Licencia:', null, ['class' => 'control-label']) }}
			@if ($software->tipo==2)
				{!! Form::select("tipoLicencia", $tipos, null, ['class' => 'js-example-basic-multiple form-control',
																'placeholder'=>'Seleccionar...']) !!}
			@endif
			@if ($software->tipo==1)
				{!! Form::select("tipoLicencia[]", $tipos, $software->tipo_licencia_id, ['class' => 'js-example-basic-multiple form-control']) !!}
			@endif
			@error('tipoLicencia')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-5 col-sm-6 my-3">
		<div class="form-group">
			{{ Form::label('Periodo:', null, ['class' => 'control-label']) }}
			@if ($software->tipo==2)
				{!! Form::select("tipoPeriodo[]", $periodos, null, ['class' => 'js-example-basic-multiple1 form-control col-md-11',
																					'multiple'=>'multiple']) !!}
			@endif
			@if ($software->tipo==1)
				{!! Form::select("tipoPeriodo[]", $periodos, $software->periodo_id, ['class' => 'js-example-basic-multiple1 form-control col-md-10',
																					 'multiple'=>'multiple']) !!}
			@endif
			@error('tipoPeriodo')
				<small class="text-danger">{{$message}}</small>
			@enderror
		</div>
	</div>
	<div class="col-md-2 {{($software->tipo==1)?'d-none':'d-flex'}}" id="divAgregar">
		<div class="form-group mt-4">
			<br><a href="#" class="btn btn-success" onclick="llenarTable(1);"><i class="fas fa-plus-circle"></i></a>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4 d-flex justify-content-center">
				<div class="{{($software->tipo==1)?'d-none':'d-flex'}}" id="divTipo">
					<table class="table" id="tableDatos">
						<thead>
							<th>Tipo de Licencia</th>
							<th>Periodicidad</th>
							<th></th>
						</thead>
						<tbody id="tableDato">
							@php
								$num=300;
							@endphp
							@if (isset($detalles))
								@foreach ($detalles as $detalle)
									@php
										$num++;
									@endphp
									<tr id='fila{{$num}}'>
										<td><input name='tiposid[]' type='hidden' value='{{$detalle->idt}}'>{{$detalle->tipo}}</td>
										<td><input name='periodosid[]' type='hidden' value='{{$detalle->idp}}'>{{$detalle->periodo}}</td>
										<td><a href='#' onclick='eliminarFila({{$num}});'>
											<i class='fas fa-minus-circle text-danger'></i></a></td>
									</tr>
								@endforeach
							@else
								<tr id="fila0">
									<td colspan='3'><span class="text-danger text-center">Agregar tipo de Licencias y Periodos</span></td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-4"></div>
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