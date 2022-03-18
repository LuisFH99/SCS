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
use App\Models\DetalleSoftware;
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
        return view('home');
    }
    public function index1()
    {
        return view('reportes');
    }
    public function mostrarPDF(Request $request){
        if($request->id==0){
            $fecha=entidad::select(/*'nombre',*/DB::raw('curdate() as fech'))/*->where('id',$request->id)*/->first();
            $encargados=entidad::join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                ->select('encargado.*','nombre','tipo')->get();
            $url='pdfs/General-'.$fecha->fech.'.pdf';
            $pdf = PDF::loadView ( 'PDFs.reporteGeneral' , compact('encargados','nSubEnt','nArea'));
            $pdf->save($url);
            $url='/'.$url;
            $dato = compact('url');
        }else{
            $fecha=entidad::select('nombre',DB::raw('curdate() as fech'))
                            ->where('id',$request->id)->first();
            $encargados=encargado::join('entidad','encargado.entidad_id','entidad.id')
                ->join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                ->select('encargado.*','nombre','tipo')->where('entidad.id',$request->id)->first();
            $subEnts=subentidad::where('entidad_id',$encargados->entidad_id)->get();
            $tipos=DB::table('tipo')->get();
            $areas=area::join('subentidad','area.subentidad_id','subentidad.id')
                            ->join('entidad','subentidad.entidad_id','entidad.id')
                            ->join('tipo','area.tipo_id','tipo.id')
                            ->select('entidad.nombre as entidad','subentidad.nombre as sub','nom_tip','area.*')
                            ->where('entidad_id',$encargados->entidad_id)->get();
            $labs=area::join('subentidad','area.subentidad_id','subentidad.id')
                            ->join('tipo','area.tipo_id','tipo.id')
                            ->select('nom_tip')
                            ->where('entidad_id',$encargados->entidad_id)->groupBy('nom_tip')->get();
            $detalles=DetalleSoftware::join('subentidad','detalle_software.subentidad_id','subentidad.id')
                                        ->join('entidad','subentidad.entidad_id','entidad.id')
                                        ->join('sft_especializado','detalle_software.sft_especializado_id','sft_especializado.id')
                                        ->select('detalle_software.*','entidad.nombre as enti','subentidad.nombre as subenti',
                                                'sft_especializado.nombre','sft_especializado.nombre as sft_nom', 
                                                'sft_especializado.año as anio', 'version', 'caracteristicas', 'tipo_licencia_id')
                                        ->where('entidad.id',$encargados->entidad_id)->get();
            $sftGenerales=DB::table('sft_predeterminado')->get();
            $url='pdfs/'.$fecha->nombre.' - '.$fecha->fech.'.pdf';
            $pdf = PDF::loadView ('PDFs.reporteGeneral' , compact('encargados','subEnts','areas','tipos','labs','detalles','sftGenerales'));
            $pdf->save($url);
            $entidad=$encargados->nombre;
            $url='/'.$url;
            $dato = compact('entidad','url');
        }
        return $dato;
    }
}
