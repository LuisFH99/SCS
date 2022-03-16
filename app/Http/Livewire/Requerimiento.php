<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Area;
use App\Models\SoftwarePredeterminado;
use App\Models\SoftwareEspecializado;
use App\Models\DetalleSoftware;

class Requerimiento extends Component
{
    public $codigo, $numpc;
    public $abrirmodal=false;
    public $totalpc;
    public $id_subentidad;

    protected $rules=[
        'codigo'=>'required',
        'numpc'=>'required|integer',
    ];
    protected $msjError=[
        'codigo.required'=>'El campo Codigo es obligatorio',
        'numpc.required'=>'El campo Numero de PCs es obligtorio',
        'numpc.integer'=>'El campo Numero de PCs debe ser numérico'
    ];

    public function mount()
    {
        $this->id_subentidad=request('id');
    }

    public function render()
    {
        $this->totalpc=Area::where('subentidad_id',$this->id_subentidad)->sum('num_pc');;
        $areas=Area::where('subentidad_id',$this->id_subentidad)->get();
        $sftpredeterminado=SoftwarePredeterminado::all();
        $sftespecializado=SoftwareEspecializado::all();
        return view('livewire.requerimiento.view',compact('areas','sftpredeterminado','sftespecializado'));
    }

    public function limpiar()
    {
        $this->codigo="";
        $this->numpc="";
    }

    public function modocrear()
    {
        $this->abrirmodal=true;
    }
    public function cancel()
    {
        $this->abrirmodal=false;
        $this->limpiar();
    }

    public function storeArea()
    {
        $this->validate($this->rules,$this->msjError);
        
        if(Area::where('codigo',$this->codigo)->where('subentidad_id',$this->id_subentidad)->doesntExist())
        {
            $creado = Area::create([
                'codigo' => $this->codigo,
                'num_pc' => $this->numpc,
                'tipo_id' => 1,
                'subentidad_id' => $this->id_subentidad
            ]);
            $this->limpiar();
    
            if (isset($creado)) {
                $datos = [
                    'modo' => 'bg-success',
                    'mensaje' => 'Registro creada satisfactoriamente.'
                ];
                $this->abrirmodal = false;
            } else {
                $datos = [
                    'modo' => 'bg-danger',
                    'mensaje' => 'Error! No se creo el registro.'
                ];
            }

        }else{
            $datos = [
                'modo' => 'bg-warning',
                'mensaje' => 'El area ya se encuetra Registrado.'
            ];

        }

        $this->emit('alertaArea', $datos);
    }
    public function deleteArea($idarea)
    {
        if(DetalleSoftware::where('area_id',$idarea)->doesntExist())
        {
            Area::destroy($idarea);
            $datos = [
                'modo' => 'bg-success',
                'mensaje' => 'Se elimino el area.'
            ];
            
        }
        $this->emit('alertaArea', $datos);
    }

}
