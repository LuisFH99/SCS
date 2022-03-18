<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidad';


    public function subentidades()
    {
        return $this->hasMany(Subentidad::class,'entidad_id','id');

    }
}
