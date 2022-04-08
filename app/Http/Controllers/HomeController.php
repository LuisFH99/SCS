<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\encargado;
use App\Models\entidad;
use App\Models\subentidad;
use App\Models\area;
use App\Models\tipo_entidad;
use App\Models\DetalleRequerimiento;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=auth()->user()->getRoleNames();
        return $user;
    }
    public function index1()
    {
        return view('reportes');
    }
    public function mostrarPDF(Request $request){
        if($request->id==0){
            // $fecha=entidad::select(/*'nombre',*/DB::raw('curdate() as fech'))/*->where('id',$request->id)*/->first();
            // $encargados=entidad::join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
            //     ->select('encargado.*','nombre','tipo')->get();
            // $url='pdfs/General-'.$fecha->fech.'.pdf';
            // $pdf = PDF::loadView ( 'PDFs.reporteGeneral' , compact('encargados','nSubEnt','nArea'));
            // $pdf->save($url);
            // $url='/'.$url;
            // $dato = compact('url');
        }else{
            $fecha=entidad::select('nombre',DB::raw('curdate() as fech'))
                            ->where('id',$request->id)->first();
            $encargados=encargado::join('entidad','encargado.entidad_id','entidad.id')
                ->join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                ->select('encargado.*','nombre','tipo')->where('entidad.id',$request->id)->first();
            $subEnts=subentidad::where('entidad_id',$encargados->entidad_id)->get();
            $tipos=DB::table('tipo')->get();
            $labs=subentidad::join('tipo','subentidad.tipo_id','tipo.id')
                            ->select('nom_tip')
                            ->where('entidad_id',$encargados->entidad_id)->groupBy('nom_tip')->get();
            $detalles=DetalleRequerimiento::join('subentidad','requerimiento.subentidad_id','subentidad.id')
                                        ->join('entidad','subentidad.entidad_id','entidad.id')
                                        ->join('det_software','requerimiento.det_software_id','det_software.id')
                                        ->join('sft_especializado','det_software.sft_especializado_id','sft_especializado.id')
                                        ->join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                        ->join('periodo','det_software.periodo_id','periodo.id')
                                        ->select('requerimiento.*','entidad.nombre as enti','subentidad.nombre as subenti',
                                                'sft_especializado.nombre','sft_especializado.nombre as sft_nom', 
                                                'sft_especializado.año as anio', 'version', 'tipo_licencia_id','tipo','periodo')
                                        ->where('entidad.id',$encargados->entidad_id)->get();
            $sftGenerales=DB::table('sft_predeterminado')
                                    ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                    ->join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                    ->select('sft_predeterminado.*','tipo','periodo')->get();
            $url='pdfs/'.$fecha->nombre.' - '.$fecha->fech.'.pdf';
            $pdf = PDF::loadView ('PDFs.reporteGeneral' , compact('encargados','subEnts','tipos','labs','detalles','sftGenerales'));
            $pdf->save($url);
            $entidad=$encargados->nombre;
            $url='/'.$url;
            $dato = compact('entidad','url'); 
        }
        return $dato;
    }
}
