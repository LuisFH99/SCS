<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSoftware extends Model
{
    use HasFactory;
    protected $table = 'detalle_software';
    protected $fillable=[
        'id',
        'precio_referencial',
        'cotizacion',
        'observacion',
        'cantidad',
        'sft_especializado_id',
        'subentidad_id',
    ];
    public $timestamps = false;

    public function software()
    {
        return $this->belongsTo(SoftwareEspecializado::class,'sft_especializado_id','id');

    }
}
