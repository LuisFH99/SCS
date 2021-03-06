<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subentidad extends Model
{
    use HasFactory;
    protected $table = 'subentidad';
    protected $fillable=[
        'id',
        'nombre',
        'estado',
        'entidad_id',
    ];
    public $timestamps = false;
    
}
