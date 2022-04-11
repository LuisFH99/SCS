<div class="row">
    @if ($subentidad->estado == 0)
        <div class="col-12 d-flex justify-content-center">
            <div class="col-11 my-2">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $verarea ? 'active' : '' }}" wire:click="area"
                                    id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home"
                                    role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                                    <h5>Identificacion</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ $versoftware ? 'active' : '' }}" wire:click="software"
                                    id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                    aria-selected="false">
                                    <h5>Softwares</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $verreq ? 'active' : '' }}" wire:click="requerimiento"
                                    id="custom-tabs-four-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-four-required" role="tab"
                                    aria-controls="custom-tabs-four-required" aria-selected="false">
                                    <h5>Mi Requerimiento</h5>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade {{ $verarea ? 'active show' : '' }}" id="custom-tabs-four-home"
                                role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <div class="card ">
                                    <div class="card-header" style="background: #c3c3c375">
                                        <h3 class="card-title font-weight-bold py-2">NUMERO DE TOTAL DE PC's:
                                            {{ $subentidad->num_pc }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label class="form-label">Nombre:</label>
                                            <p class="h6 form-control">{{ $subentidad->nombre }}</p>

                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Numero de PC's:</label>
                                            <input type="text" class="form-control"
                                                value="{{ $subentidad->num_pc }}" name="numpc" maxlength="3"
                                                autocomplete="off" onkeypress="return SoloNumeros(event)"
                                                wire:model="numpc">
                                            @error('numpc')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror


                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-success" type="button" wire:click="GuardarPc"
                                                style="margin-top: 30px;"><i class="far fa-save"></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $versoftware ? 'active show' : '' }}"
                                id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header" style="background: #c3c3c375">

                                                <h3 class="card-title col-10"><i class="fab fa-uncharted mr-1"></i>
                                                    <strong>Catálogo de Softwares</strong>
                                                </h3>

                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="input-group rounded col-md-9 mb-2">
                                                        <label for="" class="col-md-3 col-form-label">Buscar
                                                            Software:</label>
                                                        <input type="search" wire:model="buscar"
                                                            class="form-control rounded d-flex" placeholder="Buscar"
                                                            aria-label="Search" aria-describedby="search-addon" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text border-0" id="search-addon">
                                                                <i class="fas fa-search"></i>
                                                        </div>
                                                        </span>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered table-sm">
                                                    <thead class="bg-olive">
                                                        <tr style="font-size:16px; text-align: center;">
                                                            <th style="width: 10px; vertical-align:middle;">#</th>
                                                            <th style="vertical-align:middle;">Nombre</th>
                                                            <th style="vertical-align:middle;">Año</th>
                                                            <th style="vertical-align:middle;">Version</th>

                                                            <th style="vertical-align:middle;">Añadir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($sftespecializado->count())
                                                            @php
                                                                $num = 1;
                                                            @endphp
                                                            @foreach ($sftespecializado as $software)
                                                                <tr style="font-size:14px; text-align: center">
                                                                    <td style="vertical-align:middle;">
                                                                        {{ $num++ }}.</td>
                                                                    <td style="vertical-align:middle;">
                                                                        {{ $software->nombre }}</td>
                                                                    <td style="vertical-align:middle;">
                                                                        {{ $software->año }}</td>
                                                                    <td style="vertical-align:middle;">
                                                                        {{ $software->version }}</td>

                                                                    <td style="vertical-align:middle;">
                                                                        <h4><i class="fas fa-plus-circle text-green"
                                                                                wire:click="seleccion({{ $software->id }})"></i>
                                                                        </h4>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr style="font-size:14px; text-align: center">
                                                                <td colspan="5" style="vertical-align:middle;">No Hay
                                                                    Registros <b>Comuniquese con Ogtise</b> </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <div class="col-12 d-flex justify-content-center">
                                                    {{ $sftespecializado->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('livewire.requerimiento.registrar')
                                    {{-- <div class="col-12">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <label class="form-label">Software: <strong
                                                                style="color: red">*</strong> </label>
                                                        <p class="h6 form-control">{{ $nombresf }}</p>
                                                        @error('id_software')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Cantidad: (Maximo
                                                            {{ $subentidad->num_pc }}) <strong
                                                                style="color: red">*</strong> </label>
                                                        <input type="text" class="form-control" maxlength="2"
                                                            onkeypress="return SoloNumeros(event)"
                                                            wire:model="cantidad">
                                                        @error('cantidad')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        @php
                                                                $ids = [0];
                                                        @endphp
                                                        <label class="form-label">Tipo de Licencia: <strong
                                                                style="color: red">*</strong> </label>
                                                        <select wire:model="tipolc" id="tipolc" name="tipolc"
                                                            class="form-control">
                                                            <option selected="selected" value="">Seleccione...</option>
                                                            @if (isset($licencias))

                                                                @foreach ($licencias as $licencia)
                                                                
                                                                    @if(!(in_array($licencia->tipolicencia->id, $ids, true)))
                                                                    @php
                                                                         $ids[]=$licencia->tipolicencia->id;
                                                                    @endphp
                                                                   
                                                                    <option value="{{ $licencia->tipolicencia->id }}">
                                                                        {{ $licencia->tipolicencia->tipo }}</option>
                                                                    @endif
                                                                    
                                                                @endforeach
                                                                
                                                            @endif
                                                        </select>
                                
                                                        
                                                        @error('tipolc')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                   
                                                    <div class="col-4">
                                                        <label class="form-label">Peridodo: <strong
                                                                style="color: red">*</strong> </label>
                                                        <select wire:model="periodo" id="periodo" name="periodo"
                                                            class="form-control">
                                                            <option selected="selected" value="">Seleccione...</option>
                                                            @if (isset($periodos))
                                                                @foreach ($periodos as $periodo)
                                                                    <option value="{{ $periodo->tipoperiodo->id }}">
                                                                        {{ $periodo->tipoperiodo->periodo }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('periodo')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Precio Referencial: <strong
                                                                style="color: red">*</strong> </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S/.</span>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                wire:model="precio">
                                                        </div>
                                                        @error('precio')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-5">
                                                        <label class="form-label">Cotización: <strong
                                                                style="color: red">*</strong></label>
                                                        <input type="file" class="form-control-file" id="uploadedfile"
                                                            wire:model="cotizacion"
                                                            accept="application/pdf, image/png, image/jpeg">
                                                        @error('cotizacion')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6 mt-1">
                                                        <label class="form-label">Observacion:</label>
                                                        <textarea class="form-control" name="descripcion" rows="2"></textarea>

                                                    </div>
                                                    <div class="alert alert-warning col-6 mt-2">
                                                        
                                                        <h6><i class="icon fas fa-exclamation-triangle"></i> <b>Advertencia!</b> Tener en cuenta lo siguiente</h6>
                                                        Los datos de la licencia requerida deben ser acorde, a la cotización que se envía.
                                                    </div>

                                                    <div
                                                        class="col-12 text-center d-flex justify-content-center align-items-end">
                                                        <button class="btn btn-primary mr-1" wire:click="registrar"> <i
                                                                class="fas fa-tasks"></i> Registrar</button>
                                                        <button class="btn btn-danger " wire:click="limpiar"> <i
                                                                class="far fa-times-circle mr-1"></i> Cancelar</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="tab-pane fade {{ $verreq ? 'active show' : '' }}"
                                id="custom-tabs-four-required" role="tabpanel"
                                aria-labelledby="custom-tabs-four-required-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-info">
                                                <h3 class="card-title col-10"><i class="fas fa-list-ol mr-1"></i>
                                                    <b>Requerimientos</b>
                                                </h3>
                                                <button type="button" class="btn btn-primary btn-sm col-2"
                                                    wire:click="$emit('confirmValidaRequerimiento',{{ $id_subentidad }})">
                                                    <i class="fas fa-check-double"></i> Validar Requerimiento
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-sm">
                                                    <thead class="bg-olive">
                                                        <tr style="font-size:16px; text-align: center;">
                                                            <th colspan="2" style="width: 10px;vertical-align:middle;">#
                                                            </th>
                                                            <th style="vertical-align:middle;">Software</th>
                                                            <th style="width: 100px;vertical-align:middle;">Tipo de
                                                                Licencia</th>
                                                            <th style="width: 80px;vertical-align:middle;">Periodo</th>
                                                            <th style="width: 80px;vertical-align:middle;">Cantidad</th>
                                                            <th style="width: 150px;vertical-align:middle;">Precio
                                                                Referencial</th>
                                                            <th style="width: 150px;vertical-align:middle;">Sub total
                                                                (S/.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $num = 1;
                                                            $sumaTotal = 0;
                                                        @endphp
                                                        @foreach ($sftpredeterminado as $item)
                                                            <tr>
                                                                <td colspan="2" style="text-align: right;">
                                                                    {{ $num++ }}.</td>
                                                                <td>{{ $item->nombre }}</td>
                                                                <td style="text-align: center;"><small
                                                                        class="badge badge-secondary">{{ $item->licencia->tipo }}</small>
                                                                </td>
                                                                <td style="text-align: center;"><small
                                                                        class="badge badge-primary">{{ $item->periodo->periodo }}</small>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    {{ $subentidad->num_pc }}</td>
                                                                <td style="text-align: center;">S/
                                                                    {{ number_format($item->precio_referencial, 2) }}
                                                                </td>
                                                                <td style="text-align: right;">S/
                                                                    {{ number_format($subentidad->num_pc * $item->precio_referencial, 2) }}
                                                                </td>
                                                                @php
                                                                    $sumaTotal += $subentidad->num_pc * $item->precio_referencial;
                                                                @endphp
                                                            </tr>
                                                        @endforeach
                                                        @if (count($requerimientos) > 0)
                                                            @foreach ($requerimientos as $requerimiento)
                                                                <tr>
                                                                    <td style="width: 10px;"><i
                                                                            class="fas fa-minus-circle text-red"
                                                                            wire:click="$emit('confirmQuitarSoftware',{{ $requerimiento->id }})"></i>
                                                                    </td>
                                                                    <td style="width: 10px">{{ $num++ }}.</td>
                                                                    <td>{{ $requerimiento->detallesoftware->software->nombre }}
                                                                    </td>
                                                                    <td style="text-align: center;"><small
                                                                            class="badge badge-secondary">{{ $requerimiento->detallesoftware->tipolicencia->tipo }}</small>
                                                                    </td>
                                                                    <td style="text-align: center;"><small
                                                                            class="badge badge-primary">{{ $requerimiento->detallesoftware->tipoperiodo->periodo }}</small>
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        {{ $requerimiento->cantidad }}</td>
                                                                    <td style="text-align: center;">S/
                                                                        {{ number_format($requerimiento->precio_referencial, 2) }}
                                                                    </td>
                                                                    <td style="text-align: right;">S/
                                                                        {{ number_format($requerimiento->cantidad * $requerimiento->precio_referencial, 2) }}
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $sumaTotal += $requerimiento->cantidad * $requerimiento->precio_referencial;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                        <tr>
                                                            <td colspan="7" style="text-align: right;"><strong>Total
                                                                    S/.</strong> </td>
                                                            <td style="text-align: right;"><strong>S/
                                                                    {{ number_format($sumaTotal, 2) }}</strong> </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>
        {{-- @include('livewire.requerimiento.create') --}}
    @else
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Su Requerimiento fue Validado</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i>
                        </button>
                    </div>

                </div>

                <div class="card-body" style="display: block;">

                    <table class="table table-bordered table-sm">
                        <thead class="bg-olive">
                            <tr style="font-size:16px; text-align: center;">
                                <th style="width: 40px;vertical-align:middle;">#
                                </th>
                                <th style="vertical-align:middle;">Software</th>
                                <th style="width: 100px;vertical-align:middle;">Tipo de
                                    Licencia</th>
                                <th style="width: 80px;vertical-align:middle;">Periodo</th>
                                <th style="width: 80px;vertical-align:middle;">Cantidad</th>
                                <th style="width: 150px;vertical-align:middle;">Precio
                                    Referencial</th>
                                <th style="width: 150px;vertical-align:middle;">Sub total
                                    (S/.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                                $sumaTotal = 0;
                            @endphp
                            @foreach ($sftpredeterminado as $item)
                                <tr>
                                    <td style="text-align: center;">
                                        {{ $num++ }}.</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td style="text-align: center;"><small
                                            class="badge badge-secondary">{{ $item->licencia->tipo }}</small>
                                    </td>
                                    <td style="text-align: center;"><small
                                            class="badge badge-primary">{{ $item->periodo->periodo }}</small>
                                    </td>
                                    <td style="text-align: center;">
                                        {{ $subentidad->num_pc }}</td>
                                    <td style="text-align: center;">S/
                                        {{ number_format($item->precio_referencial, 2) }}
                                    </td>
                                    <td style="text-align: right;">S/
                                        {{ number_format($subentidad->num_pc * $item->precio_referencial, 2) }}
                                    </td>
                                    @php
                                        $sumaTotal += $subentidad->num_pc * $item->precio_referencial;
                                    @endphp
                                </tr>
                            @endforeach
                            @if (count($requerimientos) > 0)
                                @foreach ($requerimientos as $requerimiento)
                                    <tr>
                                        <td style="text-align: center;">{{ $num++ }}.</td>
                                        <td>{{ $requerimiento->detallesoftware->software->nombre }}</td>
                                        <td style="text-align: center;"><small
                                                class="badge badge-secondary">{{ $requerimiento->detallesoftware->tipolicencia->tipo }}</small>
                                        </td>
                                        <td style="text-align: center;"><small
                                                class="badge badge-primary">{{ $requerimiento->detallesoftware->tipoperiodo->periodo }}</small>
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $requerimiento->cantidad }}</td>
                                        <td style="text-align: center;">S/
                                            {{ number_format($requerimiento->precio_referencial, 2) }}
                                        </td>
                                        <td style="text-align: right;">S/
                                            {{ number_format($requerimiento->cantidad * $requerimiento->precio_referencial, 2) }}
                                        </td>
                                    </tr>
                                    @php
                                        $sumaTotal += $requerimiento->cantidad * $requerimiento->precio_referencial;
                                    @endphp
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="6" style="text-align: right;"><strong>Total
                                        S/.</strong> </td>
                                <td style="text-align: right;"><strong>S/
                                        {{ number_format($sumaTotal, 2) }}</strong> </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    @endif
</div>
<script>
    window.onload = function() {
        miNotificacion();
    }
</script>
