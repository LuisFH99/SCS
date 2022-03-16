<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encargado;
use App\Models\Entidad;

class Dependencias extends Component
{
    public $idencargado;
    public $identidad;
    public function mount()
    {
        $this->identidad=Encargado::where('correo',auth()->user()->email)->value('entidad_id');
    }
    public function render()
    {
        $entidades = Entidad::where('id',$this->identidad)->get();
           
        return view('livewire.dependencias.view',compact('entidades'));
    }
}
