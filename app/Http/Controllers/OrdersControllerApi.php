<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\tblventas;
use App\Models\tblventadets;
use App\Models\tblproductos;
use App\Models\tblcarritos;

class OrdersControllerApi extends Controller
{
    public function index(Request $request)
    {
        return tblventas::where('intUser_id', $request->user)
            ->orderBy('intIdVenta', 'DESC')
            ->with('Dets.producto')
            ->get();
    }
    public function order(Request $request)
    {
        return tblventas::where('intIdVenta', $request->idVenta)
            ->with('Dets.producto')
            ->with('direccion.Usuario')
            ->get();
    }
    public function Orders(Request $request)
    {
        try {
            $totalPayment = 0;
            for ($x = 0; $x < count($request->cart); $x++) {
                $totalPayment += $request->cart[$x]["fltTotal"];
            };
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Stripe\Charge::create([
                "amount" => $totalPayment * 100,
                "currency" => "mxn",
                "source" => $request->tokenStripe,
                "description" => "ID User: " . $request->idUser
            ]);
            $newVenta = new tblventas();
            $newVenta->Total_Venta = $totalPayment;
            $newVenta->vchIdPayment = $charge->id;
            $newVenta->intUser_id = $request->idUser;
            $newVenta->intDireccion_id = $request->addres['_id'];
            $newVenta->created_at = now();
            $newVenta->updated_at = now();
            $newVenta->save();

            for ($x = 0; $x < count($request->cart); $x++) {
                $newVentaDets = new tblventadets();
                $newVentaDets->intIdVenta = $newVenta->id;
                $newVentaDets->intIDProd = $request->cart[$x]["idProducto"];
                $newVentaDets->intCant = $request->cart[$x]["intCant"];
                $newVentaDets->fltPrecio = $request->cart[$x]["fltPrecio"];
                $newVenta->created_at = now();
                $newVenta->updated_at = now();
                $newVentaDets->save();

                $prod = tblproductos::where('intIDProd', $request->cart[$x]["idProducto"])->get();
                tblproductos::updateOrInsert(['intIDProd' => $request->cart[$x]["idProducto"]], [
                    'intCant' => $prod[0]->intCant - $newVentaDets->intCant
                ]);
                $cart = tblcarritos::where('idCarrito', $request->cart[$x]["idCarrito"]);
                $cart->delete();
            };
            return $newVenta;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
