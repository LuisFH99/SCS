<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\encargado;
use App\Models\entidad;
use App\Models\tipo_entidad;

class UserController extends Controller
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
        //$users = User::orderBy('id', 'ASC')->get();
    return view('users.index'/*, compact('users')*/);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $entidades = entidad::pluck('nombre','id');
        $tipo=tipo_entidad::get();
        $entidades1 = entidad::join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
                                ->select('entidad.*','tipo_entidad.id as idt','tipo_entidad.tipo')->get();
        return view('users.create', compact('roles','entidades','entidades1','tipo'));
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
            'DNI' => 'required|min:00000000|max:99999999',
            'apell_pat' => 'required',
            'nombres'=> 'required',
            'telefono'=> 'required|integer||min:000000000|max:999999999',
            'correo'=> 'required|email|unique:users,email|regex:/(.*)@unasam\.edu\.pe$/i',
            'entidad'=> 'required|integer',
        ]);
        $enca=encargado::where('DNI', $request->DNI)->get()->count();
        if($enca==0){
            $encargado=encargado::create([
                'DNI'       =>$request->DNI,
                'nombres'   =>$request->nombres,
                'apell_pat' =>$request->apell_pat,
                'apell_mat' =>$request->apell_mat,
                'correo'    =>$request->correo,
                'telefono'  =>$request->telefono,
                'entidad_id'=>$request->entidad,
                'activo'    =>1,
                'borrado'   =>0
            ]);
        }else{
            $encargado=encargado::where('DNI', $request->DNI)->update(array(
                'activo'=>1,'borrado'=>0
            ));
        }
        $user=User::create([
            'name' => $request->nombres.' '.$request->apell_pat.' '.$request->apell_mat,
            'email' => $request->correo,
            'password' => Hash::make($request->DNI)
        ])->assignRole($request->roles);
        
        if ($user instanceof Model && $encargado instanceof Model) {
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
    public function show(encargado $enc)
    {
        $encargado=encargado::join('entidad', 'encargado.entidad_id', '=', 'entidad.id')
                            ->join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
                            ->select('encargado.*','entidad.nombre','tipo_entidad.tipo')
                            ->where('correo',$enc->id)->first();
        $user=User::where('email',$enc->correo)->first();
        $roles=$user->getRoleNames();
        return view('users.show', compact('user','encargado','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(encargado $encargado)
    {
        $roles = Role::get();
        $user=User::where('email',$encargado->correo)->first();
        $tipo_entidad=entidad::select('tipo_entidad_id as tipo')->where('id',$encargado->entidad_id)->first();
        $entidades = entidad::pluck('nombre','id');
        $tipo=tipo_entidad::get();
        $entidades1 = entidad::join('tipo_entidad', 'entidad.tipo_entidad_id', '=', 'tipo_entidad.id')
                                ->select('entidad.*','tipo_entidad.id as idt','tipo_entidad.tipo')->get();
        return view('users.edit', compact('user', 'roles','encargado','tipo_entidad','entidades','entidades1','tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, encargado $encargado)
    {
        $idencargado=$encargado;
        $user=encargado::where('email', $encargado->correo)->first();
        $request->validate([
            'DNI' => 'required|min:00000000|max:99999999|unique:encargado,DNI,'.$encargado->id,
            'apell_pat' => 'required',
            'nombres'=> 'required',
            'telefono'=> 'required|integer||min:000000000|max:999999999',
            'correo'=> 'required|email|regex:/(.*)@unasam\.edu\.pe$/i|unique:users,email,'.$user->id,
            'entidad'=> 'required|integer',
        ]);
        $encargado=encargado::where('id', $idencargado->id)->update(array(
            'DNI'       =>$request->DNI, 
            'nombres'   =>$request->nombres, 
            'apell_pat' =>$request->apell_pat, 
            'apell_mat' =>$request->apell_mat, 
            'correo'    =>$request->correo, 
            'telefono'  =>$request->telefono,
            'entidad_id'=>$request->entidad
        ));
        $users=User::where('id', $user->id)->update(array(
            'name' => $request->nombres.' '.$request->apell_pat.' '.$request->apell_mat,
            'email' => $request->correo,
            'password' => Hash::make($request->DNI)
        ));
        User::where('id',$user->id)->first()->roles()->sync($request->roles);
        if ($users == 1 && $encargado == 1) {
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
    public function destroy(encargado $encargado)
    {
        $user=User::where('email',$encargado->correo)->first();
        $user->delete();
        $encargado=encargado::where('id', $encargado->id)->update(array(
            'activo'    =>0, 
            'borrado'   =>1
        ));
        $mensaje='Usuario eliminado correctamente!';
        return $mensaje;
    }
    public function habilitar(Request $request)
    {
        $encargado=encargado::where('id',$request->id)->first();
        $encarga=encargado::where('id', $encargado->id)->update(array(
            'activo'    =>($request->bdr==1)?0:1
        ));
        if($request->bdr==1){//Deshabilitar
            $user=User::where('email',$encargado->correo)->first();
            $user->delete();
        }else{//Habilitar
            $user=User::create([
                'name' => $encargado->nombres.' '.$encargado->apell_pat.' '.$encargado->apell_mat,
                'email' => $encargado->correo,
                'password' => Hash::make($encargado->DNI)
            ])->assignRole('Encargado');
        }
        $mensaje='El usuario '.$encargado->nombres.' ha sido '.(($request->bdr==1)?'deshabilitado':'habilitado').' ';
        return $mensaje;
    }
}
