<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subentidad;
use App\Models\SoftwarePredeterminado;
use App\Models\DetalleRequerimiento;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ReportListSoftwares(){
        $totalpc=Subentidad::all()->sum('num_pc');
        $sftpredeterminado=SoftwarePredeterminado::all();
        $requerimientos=DetalleRequerimiento::groupBy('det_tipo_licencia_id')->groupBy('det_periodicidad_id')->select('det_tipo_licencia_id','det_periodicidad_id',DB::raw('sum(cantidad) as cantidad'))->get();
        // $requerimientos=DetalleRequerimiento::all();
        $pdf = PDF::loadView('PDFs.reporteListaSoftwares', compact('totalpc','sftpredeterminado','requerimientos'));
        $pdf->setPaper("A4", "portrait");
        // $pdf->filename("dd");
        return  $pdf->stream("Lista Softwares Requeridos.pdf");
    }
}
