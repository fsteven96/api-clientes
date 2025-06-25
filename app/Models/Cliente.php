<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'Clientes';  // Nombre exacto de la tabla
    protected $primaryKey = 'Id';
    public $timestamps = false; // Si no tienes columnas created_at, updated_at

    protected $fillable = ['Nombre', 'Telefono'];
}
