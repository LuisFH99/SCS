<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArea extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'nom_tip',
    ];
    protected $table = 'tipo';
}
