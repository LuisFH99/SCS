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
        $softwares1=SoftwareEspecializado::select('id','nombre','año','version',
                                            DB::raw('"No definido" as precio_referencial'),DB::raw('"Especializado" as tipo'))
                                        ->where('nombre','like','%'.$this->search.'%')
                                        ->orWhere('año','like','%'.$this->search.'%')
                                        ->orWhere('version','like','%'.$this->search.'%');
        $softwares=SoftwarePredeterminado::select('id','nombre','año','version','precio_referencial',
                                                                                DB::raw('"Predeterminado" as tipo'))
                                        ->where('nombre','like','%'.$this->search.'%')
                                        ->orWhere('año','like','%'.$this->search.'%')
                                        ->orWhere('version','like','%'.$this->search.'%')
                                        ->union($softwares1)->paginate();
        
        return view('livewire.softwares.listar-softwares',compact('softwares'));
    }
}
