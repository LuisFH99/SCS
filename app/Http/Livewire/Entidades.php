<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encargado;
use App\Models\Entidad;

class Entidades extends Component
{
    public $idencargado;
    public $identidad;
    
    public function mount()
    {
        if(!(Encargado::where('correo',auth()->user()->email)->doesntExist())){
            $this->identidad=Encargado::where('correo',auth()->user()->email)->value('entidad_id');
        }else{
            $this->identidad=(session()->get('identidad'));
        }
     }
    
    public function render()
    {
        
        $entidades = Entidad::where('id',$this->identidad)->get();
           
        return view('livewire.entidades.view',compact('entidades'));
    }
}
