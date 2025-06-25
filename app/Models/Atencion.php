<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = 'Atenciones'; // solo si tienes una tabla con ese nombre
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'CitaId',
        'Descripcion',
        'FechaAtencion'
    ];
}
