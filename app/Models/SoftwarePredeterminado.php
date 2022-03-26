<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwarePredeterminado extends Model
{
    use HasFactory;
    protected $table = 'sft_predeterminado';

    public function licencia()
    {
        return $this->belongsTo(TipoLicencia::class,'tipo_licencia_id','id');

    }
    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'periodo_id','id');

    }
}
