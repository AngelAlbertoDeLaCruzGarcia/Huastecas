<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\tblventadets;

class tblventas extends Model
{
    use HasFactory;
    protected $fillable = [
        'intIdVenta',
        'Total_Venta',
        'vchIdPayment',
        'intUser_id',
        'intDireccion_id',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];
    public function Usuario()
    {
        return $this->belongsTo(User::class, 'intUser_id', 'id');
    }
    public function Dets()
    {
        return $this->hasMany(tblventadets::class, 'intIdVenta', 'intIdVenta');
    }
    public function direccion()
    {
        return $this->belongsTo(tbldirecciones::class, 'intDireccion_id', 'idDirecciones');
    }
}
