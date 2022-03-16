<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class tipo_entidad extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'tipo_entidad';

    protected $fillable = [
        'tipo'
    ];
    public function entidad()
    {
        return $this->belongsTo(entidad::class);
    }
    public function tipoEntidad()
    {
        return $this->hasOneThrough(entidad::class, encargado::class,'entidad_id','encargado_id','id','id');
    }
}
