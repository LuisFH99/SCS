<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\SoftwareEspecializado;
use App\Models\SoftwarePredeterminado;

class SoftwareController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('softwares.index');
    }

    /**
     * Show the form for creating a new rsource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('softwares.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'DNI' => 'required|min:00000000|max:99999999|unique:encargado,DNI',
            'apell_pat' => 'required',
            'nombres'=> 'required',
            'telefono'=> 'required|integer||min:000000000|max:999999999',
            'correo'=> 'required|email|unique:users,email|regex:/(.*)@unasam\.edu\.pe$/i',
            'entidad'=> 'required|integer',
        ]);
        // $encargado=encargado::create([
        //     'DNI'       =>$request->DNI, 
        //     'nombres'   =>$request->nombres, 
        //     'apell_pat' =>$request->apell_pat, 
        //     'apell_mat' =>$request->apell_mat, 
        //     'correo'    =>$request->correo, 
        //     'telefono'  =>$request->telefono,
        //     'entidad_id'=>$request->entidad
        // ]);
        $sft=User::create([
            'name' => $request->nombres.' '.$request->apell_pat.' '.$request->apell_mat,
            'email' => $request->correo,
            'password' => Hash::make($request->DNI)
        ])->assignRole($request->roles);
        
        if ($sft instanceof Model) {
            toastr()->success('Usuario registrado correctamente!');
            return redirect()->route('users.index');
        }
        toastr()->error('Ha ocurrido un error, por favor inténtelo nuevamente.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SoftwareEspecializado $sft)
    {
        // $encargado=encargado::join('entidad', 'encargado.entidad_id', '=', 'entidad.id')
        //                     ->join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
        //                     ->select('encargado.*','entidad.nombre','tipo_entidad.tipo')
        //                     ->where('correo',$sft->email)->first();
        // $roles=$user->getRoleNames();
        return view('softwares.show', compact('sft'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SoftwareEspecializado $sft)
    {
        // $roles = Role::get();
        // $encargado=encargado::where('correo',$user->email)->first();
        // $tipo_entidad=entidad::select('tipo_entidad_id as tipo')->where('id',$encargado->entidad_id)->first();
        // $entidades = entidad::pluck('nombre','id');
        // $tipo=tipo_entidad::get();
        // $entidades1 = entidad::join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
        //                         ->select('entidad.*','tipo_entidad.id as idt','tipo_entidad.tipo')->get();
        return view('softwares.edit', compact('sft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SoftwareEspecializado $sft)
    {
        //$idencargado=encargado::where('correo', $user->email)->first();
        $request->validate([
            'DNI' => 'required|min:00000000|max:99999999|unique:encargado,DNI,'.$sft->id,
            'apell_pat' => 'required',
            'nombres'=> 'required',
            'telefono'=> 'required|integer||min:000000000|max:999999999',
            'correo'=> 'required|email|regex:/(.*)@unasam\.edu\.pe$/i|unique:users,email,'.$sft->id,
            'entidad'=> 'required|integer',
        ]);
        // $encargado=encargado::where('id', $idencargado->id)->update(array(
        //     'DNI'       =>$request->DNI, 
        //     'nombres'   =>$request->nombres, 
        //     'apell_pat' =>$request->apell_pat, 
        //     'apell_mat' =>$request->apell_mat, 
        //     'correo'    =>$request->correo, 
        //     'telefono'  =>$request->telefono,
        //     'entidad_id'=>$request->entidad
        // ));
        // $users=User::where('id', $user->id)->update(array(
        //     'name' => $request->nombres.' '.$request->apell_pat.' '.$request->apell_mat,
        //     'email' => $request->correo,
        //     'password' => Hash::make($request->DNI)
        // ));
        // User::where('id',$user->id)->first()->roles()->sync($request->roles);
        if ($sft == 1) {
            toastr()->success('Usuario editado correctamente!');
            return redirect()->route('users.index');
        }
        toastr()->error('Ha ocurrido un error, por favor inténtelo nuevamente.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoftwareEspecializado $sft)
    {
        // $encargado=encargado::where('correo',$user->email)->first();
        // $user->delete();
        // $encargado->delete();
        if ($sft instanceof Model) {
            toastr()->info('Usuario eliminado correctamente!');
            return redirect()->route('users.index');
        }
        toastr()->error('Ha ocurrido un error, por favor inténtelo nuevamente.');
        return back();
    }
}
