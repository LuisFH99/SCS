<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\encargado;
use App\Models\entidad;
use App\Models\tipo_entidad;

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
            $request->id='';
        }
        $fecha=entidad::select(/*'nombre',*/DB::raw('curdate() as fech'))/*->where('id',$request->id)*/->first();
        $url='pdfs/'.$fecha->fech.'.pdf';
        //$pdf = PDF::loadView ( 'PDFs.reporteGeneral' , compact('solicitudes','Motivos','DocsAd','Firmas','aux'));
        /*return  *///$pdf->save($url)/*->stream()*/;
        return '/'.$url;
    }
}
