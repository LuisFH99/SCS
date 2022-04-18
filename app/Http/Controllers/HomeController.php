<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Encargado;
use App\Models\Entidad;
use App\Models\Subentidad;
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
    public function mostrarPDF($id){
        if($id==0){
            $fecha=Entidad::select(DB::raw('curdate() as fech'))->first();
            $encargados=Encargado::join('entidad','encargado.entidad_id','entidad.id')
                ->join('tipo_entidad','entidad.id','entidad.tipo_entidad_id','tipo_entidad.id')
                ->select('encargado.*','entidad.id as idEntidad','nombre','tipo')->where('encargado.activo',1)
                ->where('encargado.borrado',0)->get();
            $entidades=Entidad::join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')->select('entidad.*','tipo')->get();
            $subEnts=Subentidad::get();
            $tipos=DB::table('tipo')->get();
            $labs=Subentidad::join('tipo','subentidad.tipo_id','tipo.id')
                            ->select('nom_tip')->groupBy('nom_tip')->get();
            $detalles=DetalleRequerimiento::join('subentidad','requerimiento.subentidad_id','subentidad.id')
                                        ->join('entidad','subentidad.entidad_id','entidad.id')
                                        ->join('det_software','requerimiento.det_software_id','det_software.id')
                                        ->join('sft_especializado','det_software.sft_especializado_id','sft_especializado.id')
                                        ->join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                        ->join('periodo','det_software.periodo_id','periodo.id')
                                        ->select('requerimiento.*','entidad.nombre as enti','entidad.id as idEntidad',
                                                'subentidad.nombre as subenti','subentidad.id as idSubentidad',
                                                'sft_especializado.nombre as sft_nom', 'sft_especializado.id as idSft',
                                                'sft_especializado.año as anio', 'version', 'tipo_licencia_id','tipo','periodo')
                                        ->get();
            $sftGenerales=DB::table('sft_predeterminado')
                                    ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                    ->join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                    ->select('sft_predeterminado.*','tipo','periodo')->get();
            $url='pdfs/'.$fecha->nombre.' - '.$fecha->fech.'.pdf';
            $pdf = PDF::loadView ('PDFs.reporteTotal' , compact('entidades','encargados','subEnts','tipos','labs','detalles','sftGenerales'));
            return $pdf->stream()/*download($fecha->nombre.' - '.$fecha->fech.'.pdf')*/;
        }else{
            if($id==-1){
                $fecha=Entidad::select(DB::raw('curdate() as fech'))->first();
                $encargados=Encargado::join('entidad','encargado.entidad_id','entidad.id')
                    ->join('tipo_entidad','entidad.id','entidad.tipo_entidad_id','tipo_entidad.id')
                    ->select('encargado.*','entidad.id as idEntidad','nombre','tipo')->where('encargado.activo',1)
                    ->where('encargado.borrado',0)->get();
                $entidades=Entidad::join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')->select('entidad.*','tipo')->get();
                $subEnts=Subentidad::get();
                $tipos=DB::table('tipo')->get();
                $labs=Subentidad::join('tipo','subentidad.tipo_id','tipo.id')
                                ->select('nom_tip')->groupBy('nom_tip')->get();
                $detalles=DetalleRequerimiento::join('subentidad','requerimiento.subentidad_id','subentidad.id')
                                            ->join('entidad','subentidad.entidad_id','entidad.id')
                                            ->join('det_software','requerimiento.det_software_id','det_software.id')
                                            ->join('sft_especializado','det_software.sft_especializado_id','sft_especializado.id')
                                            ->join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                            ->join('periodo','det_software.periodo_id','periodo.id')
                                            ->select('requerimiento.*','entidad.nombre as enti','entidad.id as idEntidad',
                                                    'subentidad.nombre as subenti','subentidad.id as idSubentidad',
                                                    'sft_especializado.nombre as sft_nom', 'sft_especializado.id as idSft',
                                                    'sft_especializado.año as anio', 'version', 'tipo_licencia_id','tipo','periodo')
                                            ->get();
                $sftGenerales=DB::table('sft_predeterminado')
                                        ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                        ->join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                        ->select('sft_predeterminado.*','tipo','periodo')->get();
                $url='pdfs/'.$fecha->nombre.' - '.$fecha->fech.'.pdf';
                $pdf = PDF::loadView ('PDFs.reporteResumen' , compact('entidades','encargados','subEnts','tipos','labs','detalles','sftGenerales'));
                return $pdf->stream()/*download($fecha->nombre.' - '.$fecha->fech.'.pdf')*/;
            }else{
                $fecha=Entidad::select('nombre',DB::raw('curdate() as fech'))
                            ->where('id',$id)->first();
                $encargados=Encargado::join('entidad','encargado.entidad_id','entidad.id')
                    ->join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                    ->select('encargado.*','nombre','tipo')->where('entidad.id',$id)
                    ->where('encargado.activo',1)->where('encargado.borrado',0)->first();
                $entidad=Entidad::join('tipo_entidad','entidad.tipo_entidad_id','tipo_entidad.id')
                    ->select('entidad.*','tipo')->where('entidad.id',$id)->first();
                $subEnts=Subentidad::where('entidad_id',$entidad->id)->get();
                $tipos=DB::table('tipo')->get();
                $labs=Subentidad::join('tipo','subentidad.tipo_id','tipo.id')
                                ->select('nom_tip')
                                ->where('entidad_id',$entidad->id)->groupBy('nom_tip')->get();
                $detalles=DetalleRequerimiento::join('subentidad','requerimiento.subentidad_id','subentidad.id')
                                            ->join('entidad','subentidad.entidad_id','entidad.id')
                                            ->join('det_software','requerimiento.det_software_id','det_software.id')
                                            ->join('sft_especializado','det_software.sft_especializado_id','sft_especializado.id')
                                            ->join('tipo_licencia','det_software.tipo_licencia_id','tipo_licencia.id')
                                            ->join('periodo','det_software.periodo_id','periodo.id')
                                            ->select('requerimiento.*','entidad.nombre as enti','subentidad.nombre as subenti',
                                                    'sft_especializado.nombre','sft_especializado.nombre as sft_nom', 
                                                    'sft_especializado.año as anio', 'version', 'tipo_licencia_id','tipo','periodo')
                                            ->where('entidad.id',$entidad->id)->get();
                $sftGenerales=DB::table('sft_predeterminado')
                                        ->join('tipo_licencia','sft_predeterminado.tipo_licencia_id','tipo_licencia.id')
                                        ->join('periodo','sft_predeterminado.periodo_id','periodo.id')
                                        ->select('sft_predeterminado.*','tipo','periodo')->get();
                $url='pdfs/'.$fecha->nombre.' - '.$fecha->fech.'.pdf';
                $pdf = PDF::loadView ('PDFs.reporteGeneral' , compact('entidad','encargados','subEnts','tipos','labs','detalles','sftGenerales'));
                //$pdf->save($url);
                return $pdf->stream()/*download($fecha->nombre.' - '.$fecha->fech.'.pdf')*/;
            }
        }
        //return $dato;
    }
}
