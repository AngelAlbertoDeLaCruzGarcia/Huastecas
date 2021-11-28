<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblproductos;

class ProductControllerApi extends Controller
{
    public function index()
    {
        $prod = tblproductos::orderBy('intIDProd', 'desc')
            ->get();
        return $prod;
    }
    public function show($idprod)
    {
        $datops = tblproductos::where('intIDProd', $idprod)->first();
        return $datops;
    }
    public function buscarProd(Request $request)
    {
        $pa = tblproductos::where('vchProd', 'LIKE', '%' . $request->p . '%')
            ->orWhere('vchDesc', 'LIKE', '%' . $request->p . '%')
            ->orWhere('intIdCat', 'LIKE', '%' . $request->p . '%')
            ->get();
        return $pa;
    }
    public function filterProd(Request $request)
    {
        $pa = tblproductos::where('vchTalla', '=', $request->extra_chica)
            ->orWhere('vchTalla', '=', $request->chica)
            ->orWhere('vchTalla', '=', $request->mediana)
            ->orWhere('vchTalla', '=', $request->grande)
            ->get();
        return $pa;
    }
    public function IDProducto()
    {
        $pa = tblproductos::select('intIDProd')
            ->get();
        return $pa;
    }
}
