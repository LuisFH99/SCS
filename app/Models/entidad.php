<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class entidad extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'entidad';

    protected $fillable = [
        'nombre','tipo_entidad_id'
    ];
    public function encargado()
    {
        return $this->hasOne(encargado::class,'entidad_id','id');
    }
    // public function encargado()
    // {
    //     return $this->belongsTo(encargado::class);
    // }
    public function tipo_entidad()
    {
        return $this->hasMany(tipo_entidad::class);
    }

}
