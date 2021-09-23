<?php

namespace App\Http\Controllers;

use App\Models\tblnotificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationControllerApi extends Controller
{
    public function index2()
    {
        $datops = tblnotificaciones::with('direccion')
            ->with('producto')
            ->get();
        return $datops;
    }
    public function index(Request $request)
    {
        $datops = tblnotificaciones::where('intUser_id', $request->idUser)
            ->with('producto')
            ->get();
        return $datops;
    }

    public function store(Request $request)
    {
        $noti = new tblnotificaciones();
        $noti->intUser_id = $request->idUser;
        $noti->intProd_id = $request->idProd;
        $noti->save();
        return response()->json($noti, 201);
    }
    public function delete($idnoti)
    {
        $noti = tblnotificaciones::where('intIDNoti', $idnoti);
        $noti->delete();
        return 204;
    }
}
