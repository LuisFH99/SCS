<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    use HasFactory;
    protected $fillable=[
        'tipo',
    ];
    protected $table = 'tipo_licencia';

    // public function detallesoftware()
    // {
    //     return $this->hasMany(DetalleSoftware::class);

    // }
}
