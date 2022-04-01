<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTipoLicencia extends Model
{
    use HasFactory;
    protected $table = 'det_tipo_licencia';
    public $timestamps = false;
    protected $fillable=[
        'tipo_licencia_id', 'sft_especializado_id',
    ];
    public function tipolicencia()
    {
        return $this->belongsTo(TipoLicencia::class,'tipo_licencia_id','id');

    }
    public function software()
    {
        return $this->belongsTo(SoftwareEspecializado::class,'sft_especializado_id','id');

    }
}
