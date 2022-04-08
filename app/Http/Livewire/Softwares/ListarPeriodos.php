<?php

namespace App\Http\Livewire\Softwares;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Periodo;
use App\Models\DetalleSoftware;

class ListarPeriodos extends Component
{
    public $sft;public $idt;
    public function render()
    {
        $periodos=DetalleSoftware::join('periodo','det_software.periodo_id','periodo.id')
                                ->select('det_software.sft_especializado_id','periodo.*')
                                ->where('sft_especializado_id',$this->sft)
                                ->where('tipo_licencia_id',$this->idt)
                                ->distinct('periodo.id')
                                ->orderBy('periodo.id','ASC')
                                ->get();
        return view('livewire.softwares.listar-periodos',compact('periodos'));
    }
}
