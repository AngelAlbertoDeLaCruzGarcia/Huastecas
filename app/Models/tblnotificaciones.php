<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblproductos;
use App\Models\tbldirecciones;

class tblnotificaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'intUser_id',
        'intProd_id',
    ];
    public function producto()
    {
        return $this->belongsTo(tblproductos::class, 'intProd_id', 'intIDProd');
    }
    public function direccion()
    {
        return $this->belongsTo(tbldirecciones::class, 'intUser_id', 'idUsuario');
    }
}
