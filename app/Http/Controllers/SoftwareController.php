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
use App\Models\TipoLicencia;
use App\Models\Periodo;
use App\Models\DetalleTipoLicencia;
use App\Models\DetallePeriodicidad;
use App\Models\DetalleSoftware;
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
        $tipos=TipoLicencia::pluck('tipo','id');
        $periodos=Periodo::pluck('periodo','id');
        return view('softwares.create', compact('tipos','periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'anio' => 'required',
            'version'=> 'required',
            'precio'=> 'numeric|between:0.00,999999.99',
            
        ]);
        if($request->tipoSofware==2){//Especializado
            $softwareE=SoftwareEspecializado::create([
                'nombre'=>$request->nombre, 
                'año'   =>$request->anio, 
                'version' =>$request->version
            ]);
            $ultimoId=SoftwareEspecializado::orderBy('id','DESC')->first();
            if(!is_null($request->tipoLicencia)&&!is_null($request->tipoPeriodo)){
                if(is_null($request->tiposid)&&is_null($request->periodosid)){
                    foreach ($request->tipoLicencia as $tipo) {
                        foreach ($request->tipoPeriodo as $periodo) {
                            $softwareE=DetalleSoftware::create([
                                'sft_especializado_id'  =>$ultimoId->id, 
                                'tipo_licencia_id'      =>$tipo, 
                                'periodo_id'      =>$periodo
                            ]);
                        }
                    }
                }
            }
            if(!is_null($request->tiposid)&&!is_null($request->periodosid)){
                //if(is_null($request->tipoLicencia)&&is_null($request->tipoPeriodo)){
                    for ($i=0; $i <count($request->tiposid) ; $i++) { 
                        $softwareE=DetalleSoftware::create([
                            'sft_especializado_id'  =>$ultimoId->id, 
                            'tipo_licencia_id'      =>$request->tiposid[$i], 
                            'periodo_id'      =>$request->periodosid[$i]
                        ]);
                    }
                //}
            }
            
            if ($softwareE instanceof Model) {
                toastr()->success('Software registrado correctamente!');
                return redirect()->route('softwares.index');
            }
        }
        if($request->tipoSofware==1){//Predeterminado 
            if(!is_null($request->tipoLicencia)&&!is_null($request->tipoPeriodo)){
                $softwareP=SoftwarePredeterminado::create([
                    'nombre'=>$request->nombre, 
                    'año'   =>$request->anio, 
                    'version' =>$request->version,
                    'precio_referencial'=>$request->precio,
                    'tipo_licencia_id'  =>$request->tipoLicencia[0],
                    'periodo_id' =>$request->tipoPeriodo[0]
                ]);
                if ($softwareP instanceof Model ) {
                    toastr()->success('Software registrado correctamente!');
                    return redirect()->route('softwares.index');
                }
            }
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
    public function edit1( $software, $tipo)
    {
        if($tipo=='Especializado'){
            //$dTipoLics=DetalleTipoLicencia::where('sft_especializado_id',$software)->get()/*pluck('tipo_licencia_id','id')*/;
            //$dPeriodos=DetallePeriodicidad::where('sft_especializado_id',$software)->get()/*pluck('periodo_id','id')*/;
            $software=SoftwareEspecializado::select('id','nombre','año','version',
                                                DB::raw('"0.00" as precio_referencial'),
                                                DB::raw('2 as tipo'))
                                            ->where('id',$software)->first();
            $detalles=DetalleSoftware::join('periodo','det_software.periodo_id','periodo.id')
                                        ->join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                        ->select('periodo.id as idp','periodo','tipo_licencia.id as idt','tipo')
                                        ->where('sft_especializado_id',$software->id)->get();
            $tipos=TipoLicencia::pluck('tipo','id');
            $periodos=Periodo::pluck('periodo','id');
            $datos=compact('software','tipos','periodos','detalles');
        }
        if($tipo=='Predeterminado'){
            $software=SoftwarePredeterminado::join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                        ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                        ->select('sft_predeterminado.id','nombre','año','version','precio_referencial',
                                                DB::raw('1 as tipo'), 
                                                'tipo_licencia.id as tipo_licencia_id', 
                                                'periodo.id as periodo_id')
                                        ->where('sft_predeterminado.id',$software)
                                        ->first();
            $tipos=TipoLicencia::pluck('tipo','id');
            $periodos=Periodo::pluck('periodo','id');
            $datos=compact('software','tipos','periodos');
        }
        
        return view('softwares.edit',$datos);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sft)
    {
        $request->validate([
            'nombre' => 'required',
            'anio' => 'required',
            'version'=> 'required',
            'precio'=> 'numeric|between:0.00,999999.99',
            
        ]);
        if($request->tipoSofware==2){//Especializado
            $softwareE=SoftwareEspecializado::where('id', $sft)->update(array(
                'nombre'=>$request->nombre, 
                'año'   =>$request->anio, 
                'version' =>$request->version
            ));
            $detalles=DetalleSoftware::where('sft_especializado_id',$sft)->get();
            foreach ($detalles as $detalle){
                $dets=DetalleSoftware::where('id',$detalle->id)->first();
                $dets->delete();
            }
            if(!is_null($request->tipoLicencia)&&!is_null($request->tipoPeriodo)){
                if(is_null($request->tiposid)&&is_null($request->periodosid)){
                    foreach ($request->tipoLicencia as $tipo) {
                        foreach ($request->tipoPeriodo as $periodo) {
                            $softwareE=DetalleSoftware::create([
                                'sft_especializado_id'  =>$$sft, 
                                'tipo_licencia_id'      =>$tipo, 
                                'periodo_id'      =>$periodo
                            ]);
                        }
                    }
                }
            }
            if(!is_null($request->tiposid)&&!is_null($request->periodosid)){
                //if(is_null($request->tipoLicencia)&&is_null($request->tipoPeriodo)){
                    for ($i=0; $i <count($request->tiposid) ; $i++) { 
                        $softwareE=DetalleSoftware::create([
                            'sft_especializado_id'  =>$sft, 
                            'tipo_licencia_id'      =>$request->tiposid[$i], 
                            'periodo_id'      =>$request->periodosid[$i]
                        ]);
                    }
                //}
            }
            
            if ($softwareE instanceof Model) {
                toastr()->success('Software editado correctamente!');
                return redirect()->route('softwares.index');
            }
        }
        if($request->tipoSofware==1){//Predeterminado 
            if(!is_null($request->tipoLicencia)&&!is_null($request->tipoPeriodo)){
                $softwareP=SoftwarePredeterminado::where('id', $sft)->update(array(
                    'nombre'=>$request->nombre, 
                    'año'   =>$request->anio, 
                    'version' =>$request->version,
                    'precio_referencial'=>$request->precio,
                    'tipo_licencia_id'  =>$request->tipoLicencia[0],
                    'periodo_id' =>$request->tipoPeriodo[0]
                ));
                if ($softwareP == 1 ) {
                    toastr()->success('Software editado correctamente!');
                    return redirect()->route('softwares.index');
                }
            }
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
    public function destroy($sft)
    {
        $datos = explode("-", $sft);
        if($datos[1]=='Especializado'){//Especializado
            $detalles=DetalleSoftware::where('sft_especializado_id',$datos[0])->get();
            foreach ($detalles as $detalle){
                $dets=DetalleSoftware::where('id',$detalle->id)->first();
                $dets->delete();
            }
            $softwareE=SoftwareEspecializado::where('id', $datos[0])->first();
            $softwareE->delete();
            if ($softwareE instanceof Model) {
                toastr()->info('Software eliminado correctamente!');
                return redirect()->route('softwares.index');
            }
        }
        if($datos[1]=='Predeterminado'){//Predeterminado 
            $softwareP=SoftwarePredeterminado::where('id', $datos[0])->first();
            $softwareP->delete();
            if ($softwareP instanceof Model) {
                toastr()->info('Software eliminado correctamente!');
                return redirect()->route('softwares.index');
            }
        }
        
        toastr()->error('Ha ocurrido un error, por favor inténtelo nuevamente.');
        return back();
    }
}
