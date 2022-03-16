<div class="card ">
    <div class="card-header" style="background: #c3c3c375">
        <h3 class="card-title font-weight-bold">NUMERO DE TOTAL DE PC's: {{$totalpc}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-info" wire:click="modocrear">
                Nuevo
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="{{ $abrirmodal ? 'modal fade show' : 'modal fade' }}" id="exampleModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true"
    style=" {{ $abrirmodal ? 'display: block;' : 'display: none' }}" aria-modal="{{ $abrirmodal ? 'true' : '' }}"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold" id="exampleModalLabel">NUEVA AREA</h5>
                <button type="button" wire:click="cancel" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="form-label">Codigo: <strong style="color: red">*</strong> </label>
                <input type="text" class="form-control" name="codigo"  autocomplete="off" wire:model="codigo">
                @error('codigo')
                    <small class="text-danger">{{ $message }}</small><br>
                @enderror
                <label class="form-label">Numero de PC's: <strong style="color: red">*</strong> </label>
                <input type="text" class="form-control" name="numpc" maxlength="3" autocomplete="off" onkeypress="return SoloNumeros(event)" wire:model="numpc">
                @error('numpc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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
                delay: 850
            })

        });
    }
</script>
