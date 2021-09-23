<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tbldirecciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'idDirecciones',
        'vchTitulo',
        'idUsuario',
        'vchDireccion',
        'vchCodigo',
        'vchPoblacion',
        'vchEstado',
        'vchPais',
        'vchTelefono',
    ];
    public function Usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'id');
    }
}
