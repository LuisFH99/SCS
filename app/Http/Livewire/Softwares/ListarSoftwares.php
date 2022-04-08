<?php

namespace App\Http\Livewire\Softwares;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SoftwarePredeterminado;
use App\Models\SoftwareEspecializado;
use App\Models\DetalleSoftware;

class ListarSoftwares extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        //DB::statement(DB::raw('SET @rownum = 0')); 
        $softwares1=SoftwareEspecializado::select('id','nombre','año','version',
                                            DB::raw('"No definido" as precio_referencial'),
                                            DB::raw('"Especializado" as tipo'), 
                                            DB::raw('0 as tipo_licencia_id'), 
                                            DB::raw('0 as periodo_id'),
                                            DB::raw('@i := @i + 1 as contador'))
                                            ->crossJoin(DB::raw('(select @i := 0) as r'))
                                        ->where('nombre','like','%'.$this->search.'%')
                                        ->orWhere('año','like','%'.$this->search.'%')
                                        ->orWhere('version','like','%'.$this->search.'%');
        $softwares=SoftwarePredeterminado::join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                        ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                        ->select('sft_predeterminado.id as id','nombre','año','version','precio_referencial',
                                                                                DB::raw('"Predeterminado" as tipo'), 
                                                                                'tipo_licencia.tipo as tipo_licencia_id', 
                                                                                'periodo.periodo as periodo_id',
                                                                                DB::raw('@i := @i + 1 as contador'))
                                                                                ->crossJoin(DB::raw('(select @i := 0) as r'))
                                        ->where('nombre','like','%'.$this->search.'%')
                                        ->orWhere('año','like','%'.$this->search.'%')
                                        ->orWhere('version','like','%'.$this->search.'%')
                                        ->union($softwares1)->paginate();
        // $periodicidadDetalles=DetalleSoftware::join('periodo','det_software.periodo_id','periodo.id')
        //                                         ->select('det_periodicidad.*','periodo')->distinct()->get();
        // $tipoLicenciasDetalles=DetalleTipoLicencia::join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
        //                                         ->select('det_tipo_licencia.*','tipo')->distinct()->get();
        return view('livewire.softwares.listar-softwares',compact('softwares'));
    }

}
