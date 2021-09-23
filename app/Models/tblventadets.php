<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblventas;
use App\Models\tblproductos;

class tblventadets extends Model
{
    use HasFactory;
    protected $fillable = [
        'intIdVentaDet',
        'intIdVenta',
        'intIDProd',
        'intCant',
        'fltPrecio',
        'created_at',
        'updated_at',
    ];
    public function Venta()
    {
        return $this->hasOne(tblventas::class, 'intIdVenta', 'intIdVenta'/*foreign key*/);
    }
    public function producto()
    {
        return $this->belongsTo(tblproductos::class, 'intIDProd', 'intIDProd');
    }
}
