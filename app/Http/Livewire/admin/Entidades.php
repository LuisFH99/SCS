<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Entidad;
use App\Models\Subentidad;

use Livewire\WithPagination;

class Entidades extends Component
{
    use WithPagination;
    public $buscar;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['cambiarestado'];


    public function render()
    {
        $entidades=Entidad::where('nombre','like','%'.$this->buscar.'%')->paginate(7);
        return view('livewire.admin.entidades.view', compact('entidades'));
    }
    public function cambiarestado($subentidad)
    {
        if($subentidad['estado'] == 1){
            Subentidad::where('id',$subentidad['id'])->update(['estado' => 0]);
            $datos = [
                'modo' => 'bg-success',
                'mensaje' => 'Se Actualizo el Estado del Registro'
            ];
           
        }else{
            Subentidad::where('id',$subentidad['id'])->update(['estado' => 1]);
            $datos = [
                'modo' => 'bg-success',
                'mensaje' => 'Se Actualizo el Estado del Registro'
            ];
            
        }
        $this->emit('alertaSistema', $datos);
        //dd($subentidad);
    }
}
