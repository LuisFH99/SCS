<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRequerimiento extends Model
{
    use HasFactory;
    protected $table = 'requerimiento';

    protected $fillable=[
        'id',
        'precio_referencial',
        'cotizacion',
        'observacion',
        'cantidad',
        'subentidad_id',
        'det_tipo_licencia_id',
        'det_periodicidad_id',
    ];
    public $timestamps = false;

    public function detallelicencia()
    {
        return $this->belongsTo(DetalleTipoLicencia::class,'det_tipo_licencia_id','id');

    }
    public function detalleperiodo()
    {
        return $this->belongsTo(DetallePeriodicidad::class,'det_periodicidad_id','id');

    }
}
