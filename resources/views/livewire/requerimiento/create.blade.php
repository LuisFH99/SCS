<!-- Modal -->
<div class="{{ $abrirmodal ? 'modal fade show' : 'modal fade' }}" id="exampleModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true"
    style=" {{ $abrirmodal ? 'display: block;' : 'display: none' }}" aria-modal="{{ $abrirmodal ? 'true' : '' }}"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold" id="exampleModalLabel">
                    {{ $creararea ? 'NUEVA AREA' : 'REGISTRAR SOFTWARE' }}</h5>
                <button type="button" wire:click="cancel" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($creararea)
                    <label class="form-label">Seleccion tipo de area: <strong style="color: red">*</strong> </label>
                    <select wire:model="tipoarea" id="tipoarea" name="tipoarea" class="form-control">
                        <option selected="selected" value="">Seleccione...</option>
                        @foreach ($tipoareas as $tipoarea)
                            <option value="{{ $tipoarea->id }}">{{ $tipoarea->nom_tip }}</option>
                        @endforeach
                    </select>
                    @error('tipoarea')
                            <small class="text-danger">{{ $message }}</small><br>
                    @enderror
                    
                    <label class="form-label">Codigo | Nombre: <strong style="color: red">*</strong> </label>
                    <input type="text" class="form-control" name="codigo" autocomplete="off" wire:model="codigo">
                    @error('codigo')
                        <small class="text-danger">{{ $message }}</small><br>
                    @enderror
                    <label class="form-label">Numero de PC's: <strong style="color: red">*</strong> </label>
                    <input type="text" class="form-control" name="numpc" maxlength="3" autocomplete="off"
                        onkeypress="return SoloNumeros(event)" wire:model="numpc">
                    @error('numpc')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                @else
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Nombre de Software: <strong style="color: red">*</strong> </label>
                        <input type="text" class="form-control" name="software" autocomplete="off" wire:model="software">
                        @error('software')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-4 my-1">
                        <label class="form-label">Año: <strong style="color: red">*</strong> </label>
                        <input type="text" class="form-control" name="año" maxlength="4" autocomplete="off"
                        onkeypress="return SoloNumeros(event)" wire:model="año">
                        @error('año')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-4 my-1">
                        <label class="form-label">Version: <strong style="color: red">*</strong> </label>
                        <input type="text" class="form-control" name="version" maxlength="10" autocomplete="off" wire:model="version">
                        @error('version')
                            <small class="text-danger">{{ $message }}</small>   
                        @enderror
                    </div>
                    <div class="col-4 my-1">
                        <label class="form-label">Tipo de Licencia: <strong style="color: red">*</strong> </label>
                        <select wire:model="tipolc" id="tipolc" name="tipolc" class="form-control">
                            <option selected="selected" value="">Seleccione...</option>
                            @foreach ($tipolicencias as $tipolicencia)
                                <option value="{{ $tipolicencia->id }}">{{ $tipolicencia->tipo }}</option>
                            @endforeach
                        </select>
                        @error('tipolc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    
                    <label class="form-label">Caracteristicas | Descripción: <strong style="color: red">*</strong> </label>
                    <textarea class="form-control" name="descripcion" rows="2" wire:model="descripcion"></textarea>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                    
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" wire:click="storeArea" class="btn btn-primary"><i
                        class="far fa-save mr-2"></i>Guardar</button>
                <button type="button" wire:click="cancel" class="btn btn-danger"><i
                        class="fas fa-times-circle mr-2"></i>Cancelar</button>
            </div>
        </div>
    </div>
</div>
@if ($abrirmodal)
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
