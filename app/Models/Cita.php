<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'Citas';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'ClienteId',
        'FechaHora',
        'Estado',
    ];
}
