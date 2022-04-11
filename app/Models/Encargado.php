<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;
    protected $table = 'encargado' ;
    protected $fillable = [
        'DNI', 'nombres', 'apell_pat', 'apell_mat', 'correo', 'telefono', 'activo','borrado','entidad_id',
    ];
}
