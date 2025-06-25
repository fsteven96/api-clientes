<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class Usuario extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'Usuarios';         
    protected $primaryKey = 'Id';         
    public $timestamps = false;          

    protected $fillable = [
        'Usuario',
        'PasswordU',
        'NombreCompleto',
        'Cargo',
    ];
}
