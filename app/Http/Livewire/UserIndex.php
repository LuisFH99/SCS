<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
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
        $users=User::join('encargado', 'users.email', '=', 'encargado.correo')
                   ->join('entidad', 'encargado.entidad_id', '=', 'entidad.id')
                   ->join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
                   ->select('users.*','encargado.DNI','entidad.nombre','tipo_entidad.tipo')
                   ->where('name','LIKE','%'.$this->search.'%')
                   ->orWhere('email','LIKE','%'.$this->search.'%')
                   ->paginate();
        return view('livewire.user-index',compact('users'));
    }
}
