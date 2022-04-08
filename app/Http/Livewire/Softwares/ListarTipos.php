<?php

namespace App\Http\Livewire\Softwares;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Periodo;
use App\Models\DetalleSoftware;

class ListarTipos extends Component
{
    public $sft;
    public function render()
    {
        $tipos=DetalleSoftware::join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                ->select('det_software.sft_especializado_id','tipo_licencia.*')
                                ->where('sft_especializado_id',$this->sft)
                                ->distinct('tipo_licencia.id')
                                ->orderBy('tipo_licencia.id','ASC')
                                ->get();
        return view('livewire.softwares.listar-tipos',compact('tipos'));
    }
}
