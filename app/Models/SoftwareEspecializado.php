<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareEspecializado extends Model
{
    use HasFactory;
    protected $table = 'sft_especializado';

    protected $fillable=[
         'nombre', 'año', 'version'
    ];
    
    public $timestamps = false;
    
    public function tiposoftware()
    {
        return $this->belongsTo(TipoLicencia::class,'tipo_licencia_id','id');

    }
}
