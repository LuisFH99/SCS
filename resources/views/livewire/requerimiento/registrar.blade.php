<div class="{{ $modoedit ? 'modal fade show' : 'modal fade' }}" id="exampleModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true"
    style=" {{ $modoedit ? 'display: block;' : 'display: none' }}" aria-modal="{{ $modoedit ? 'true' : '' }}"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold" id="exampleModalLabel">REGISTRAR SOFTWARE A REQUERIMIENTO</h5>
                <button type="button" wire:click="cancel" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <label class="form-label">Software: <strong style="color: red">*</strong>
                                </label>
                                <p class="h6 form-control">{{ $nombresf }}</p>
                                @error('id_software')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-3">
                                <label class="form-label">Cantidad: (Maximo
                                    {{ $subentidad->num_pc }}) <strong style="color: red">*</strong> </label>
                                <input type="text" class="form-control" maxlength="2"
                                    onkeypress="return SoloNumeros(event)" wire:model="cantidad">
                                @error('cantidad')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                @php
                                    $ids = [0];
                                @endphp
                                <label class="form-label">Tipo de Licencia: <strong style="color: red">*</strong>
                                </label>
                                <select wire:model="tipolc" id="tipolc" name="tipolc" class="form-control">
                                    <option selected="selected" value="">Seleccione...</option>
                                    @if (isset($licencias))

                                        @foreach ($licencias as $licencia)
                                            @if (!in_array($licencia->tipolicencia->id, $ids, true))
                                                @php
                                                    $ids[] = $licencia->tipolicencia->id;
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
                                <label class="form-label">Peridodo: <strong style="color: red">*</strong>
                                </label>
                                <select wire:model="periodo" id="periodo" name="periodo" class="form-control">
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
                                <label class="form-label">Precio Referencial: <strong style="color: red">*</strong>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/.</span>
                                    </div>
                                    <input type="text" class="form-control" wire:model="precio">
                                </div>
                                @error('precio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Cotización: (Tamaño maximo 3MB) <strong style="color: red">*</strong></label>
                                <input type="file" class="form-control-file" id="uploadedfile" wire:model="cotizacion"
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

                                <h6><i class="icon fas fa-exclamation-triangle"></i> <b>Advertencia!</b> Tener en
                                    cuenta lo siguiente</h6>
                                Los datos de la licencia requerida deben ser acorde, a la cotización que se envía.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center d-flex justify-content-center align-items-end">

                <button class="btn btn-primary mr-1" wire:click="registrar"> <i class="fas fa-tasks"></i>
                    Registrar</button>
                <button class="btn btn-danger " wire:click="cancel"> <i class="far fa-times-circle mr-1"></i>
                    Cancelar</button>

            </div>
        </div>
    </div>
</div>
@if ($modoedit)
    <div class="modal-backdrop fade show"></div>
@endif

<script>
    function miNotificacion() {
        Livewire.on('alertaArea', function(datos) {
            $(document).Toasts('create', {
                class: datos.modo,
                title: 'Mensaje de Sistema',
                body: datos.mensaje,
                autohide: true,
                delay: 950
            })
            document.getElementById("uploadedfile").value = "";
        });
    }
</script>
