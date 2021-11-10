<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Product;
use App\Models\tblproductos;
use App\Models\tblventas;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function facturar(Request $datos)
    {
        try {
            ///return $datos;
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            for ($x = 0; $x < count($datos->products); $x++) {
                $prod = \Stripe\Product::create([
                    'name' => $datos->products[$x]["vchProd"],
                    'shippable' => true
                ]);
                $price = \Stripe\Price::create([
                    'product' => $prod->id,
                    'unit_amount' => $datos->products[$x]["fltPrecio"] * 100,
                    'currency' => 'mxn',
                ]);
                $item = \Stripe\InvoiceItem::create([
                    'customer' => $datos->cliente,
                    'price' => $price->id,
                    'quantity' => '' . $datos->products[$x]["intCant"]
                ]);
            }
            ///Crear factura
            $invoice = \Stripe\Invoice::create([
                'customer' => $datos->cliente,
                'auto_advance' => false
            ]);
            //////Enviar Factura
            ///return $invoice;
            $send = \Stripe\Invoice::retrieve($invoice->id);
            $send->finalizeInvoice();
            tblventas::updateOrInsert(
                ['intIdVenta' => '' . $datos->idventa],
                [
                    'vchIdFactura' =>  $invoice->id,
                ]
            );
            return $send;
        } catch (\Exception $e) {
            return $e;
        }



        /*
        ///Listado de productos
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        return $stripe->products->all(['limit' => 3]);

        ////Crear
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $product = \Stripe\Product::create([
            'name' => 'Vestido',
            'id' => '2',
            'shippable' => true
        ]);
        return $product;

        ///Buscar
        return $stripe->products->retrieve(
            '23',
            []
        );
        ////Eliminar
        return $stripe->products->delete(
            'prod_KIP8ScZbAs78l5',
            []
        );
---------------------
        ///Listado de clientes
        $stripe->customers->all(['limit' => 3]);

        ////Crear
        $customer = $stripe->customers->create([
            'id' => 'asdasdcasvvvvvvvvvvvvs',
            'name' => 'jenny rosen',
            'email' => 'jenny.rosen@example.com',
            'description' => 'My first test customer',
            'preferred_locales' => ['es']
        ]);
        ///// Listado rfc
        return $stripe->customers->allTaxIds(
            'asdasdcasvvvvvvvvvvvvs',
            ['limit' => 3]
        );
        ////crear
        return $stripe->customers->createTaxId(
            'asdasdcasvvvvvvvvvvvvs',
            [
                'type' => 'mx_rfc', 'value' => 'CUGA991008AY4',
            ]
        );
        
        ///Luistado de precios


        ///Crear
        $price = \Stripe\Price::create([
            'product' => '2',
            'unit_amount' => 2000,
            'currency' => 'mxn',
        ]);

        ///Facturacion
        ///Crear ITems
        $item = \Stripe\InvoiceItem::create([
            'customer' => 'asdasdcasvvvvvvvvvvvvs',
            'price' => 'price_1JdpKRGSqsqx8ql0vec3K87L',
            'quantity' => '2'
        ]);
        ///Crear factura
        return \Stripe\Invoice::create([
            'customer' => 'asdasdcasvvvvvvvvvvvvs',
            'auto_advance' => false
        ]);
        //////Enviar Factura
            $invoice = \Stripe\Invoice::retrieve('in_1JeCRtGSqsqx8ql0nD7l76qV');
            $invoice->finalizeInvoice();
            $stripe->invoices->pay(
                'in_1JeCRtGSqsqx8ql0nD7l76qV',
                []
            );
        */
    }
    public function show(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $send = \Stripe\Invoice::retrieve($request->id);
        return $send;
    }
    public function index2()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        return $stripe->invoices->all(['limit' => 3]);

        ////updateOrCreate
        /*
        $flight = tblventas::updateOrCreate(
            ['intIdVenta' => '27'],
            [
                'vchIdFactura' => 'in_1JeCRtGSqsqx8ql0nD7l76qV',
            ]
        );
        return $flight;
        /*
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        ///\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            ///$send = \Stripe\Invoice::retrieve('in_1Jt8F7GSqsqx8ql0c2ogU2Jm');
            $dato = '27';
            $flight = tblventas::updateOrInsert(
                ['intIdVenta' => 27],
                [
                    'vchIdFactura' => 'in_1Jt8F7GSqsqx8ql0c2ogU2Jm',
                ]
            );
            return $flight;
            ///return $send->invoice_pdf;
            ///return $stripe->invoices->all(['limit' => 3]);
        } catch (\Exception $e) {
            return $e;
        }*/

        //return $SearchProduct;
    }
}
