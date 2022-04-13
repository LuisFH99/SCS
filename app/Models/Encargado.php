<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Encargado extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'encargado' ;
    protected $fillable = [
        'DNI', 'nombres', 'apell_pat', 'apell_mat', 'correo', 'telefono', 'activo','borrado','entidad_id',
    ];
}
