<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entidad;
use App\Models\tipo_entidad;
use Livewire\WithPagination;

class SeleccionarEntidad extends Component
{
    use WithPagination;
    public $selecttipo;
    public $selectentidad;
    public $message;
    public function updatingSelecttipo() 
    {
        $this->resetPage();
    }
    public function render()
    {
        $tipo_entidades=tipo_entidad::pluck('tipo','id');
        $entidades = Entidad::where('tipo_entidad_id', '=', $this->selecttipo)->pluck('nombre','id');
        $selectentidad=$this->selectentidad;
        return view('livewire.seleccionar-entidad',compact('tipo_entidades','entidades','selectentidad'));
    }
    
    
}
