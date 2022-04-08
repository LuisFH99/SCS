<div>
    @if (!is_null($tipos))
    <table>
        @foreach ($tipos as $tipo)
            <tr>
                <td class="align-V">{{$tipo->tipo}}</td>
                <td>@livewire('softwares.listar-periodos', ['sft' => $tipo->sft_especializado_id,'idt'=>$tipo->id], key($tipo->id))</td>
            </tr>
        @endforeach
    </table>
    @endif
</div>
