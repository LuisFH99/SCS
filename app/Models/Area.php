<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';
    protected $fillable=[
        'id',
        'codigo',
        'num_pc',
        'tipo_id',
        'subentidad_id',
    ];
    public $timestamps = false;
}
