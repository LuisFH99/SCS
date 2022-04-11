<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\encargado;

class UserIndex extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $users=encargado::join('entidad', 'encargado.entidad_id', '=', 'entidad.id')
                    ->join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
                    ->select('encargado.*','entidad.nombre','tipo_entidad.tipo',DB::raw('@i := @i + 1 as contador'))
                    ->crossJoin(DB::raw('(select @i := 0) as r'))
                    ->where('encargado.borrado',0)
                    ->where(function ($query) {
                        $query->orWhere('nombres','LIKE','%'.$this->search.'%')
                        ->orWhere('correo','LIKE','%'.$this->search.'%')
                        ->orWhere('DNI','LIKE','%'.$this->search.'%')
                        ->orWhere('telefono','LIKE','%'.$this->search.'%');
                    })
                   ->paginate();
        return view('livewire.user-index',compact('users'));
    }
}
