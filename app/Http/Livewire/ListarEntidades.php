<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\encargado;
use App\Models\entidad;
use App\Models\tipo_entidad;

class ListarEntidades extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $entidades = entidad::pluck('nombre','id');
        $tipos = tipo_entidad::pluck('tipo','id');
        $encargados=encargado::join('entidad','encargado.entidad_id','entidad.id')
                                ->join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                                ->select('encargado.*','entidad.nombre','tipo')
                                ->where('nombres','LIKE','%'.$this->search.'%')
                                ->orWhere('apell_pat','LIKE','%'.$this->search.'%')
                                ->orWhere('apell_mat','LIKE','%'.$this->search.'%')
                                ->orWhere('nombre','LIKE','%'.$this->search.'%')
                                ->orWhere('tipo','LIKE','%'.$this->search.'%')
                                ->orWhere('DNI','LIKE','%'.$this->search.'%')
                                ->paginate();
        return view('livewire.listar-entidades',compact('entidades','tipos','encargados'));
    }
}
