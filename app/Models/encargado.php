<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class encargado extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'encargado';

    protected $fillable = [
        'DNI', 'nombres', 'apell_pat', 'apell_mat', 'correo', 'telefono','entidad_id'
    ];
    public function entidad()
    {
        return $this->belongsTo(entidad::class);
    }
    
    
}
