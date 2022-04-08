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
        'det_software_id',
    ];
    public $timestamps = false;

    public function detallesoftware()
    {
        return $this->belongsTo(DetalleSoftware::class,'det_software_id','id');

    }
   
}
