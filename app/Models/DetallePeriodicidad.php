<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePeriodicidad extends Model
{
    use HasFactory;
    protected $table = 'det_periodicidad';
    public $timestamps = false;

    public function periodo()
    {
        return $this->belongsTo(Periodo::class,'periodo_id','id');

    }
    
}
