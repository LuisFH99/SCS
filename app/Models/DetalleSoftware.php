<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSoftware extends Model
{
    use HasFactory;
    protected $table = 'det_software';

    protected $fillable=[
        'id',
        'sft_especializado_id',
        'tipo_licencia_id',
        'periodo_id',
    ];
    public $timestamps = false;

    
    public function software()
    {
        return $this->belongsTo(SoftwareEspecializado::class,'sft_especializado_id','id');

    }
    public function tipolicencia()
    {
        return $this->belongsTo(TipoLicencia::class,'tipo_licencia_id','id');

    }
    public function tipoperiodo()
    {
        return $this->belongsTo(Periodo::class,'periodo_id','id');

    }
}
