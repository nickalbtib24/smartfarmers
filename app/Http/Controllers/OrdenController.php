<?php

namespace App\Http\Controllers;


use App\Factura;
use App\User;
use App\Orden;
use App\Producto;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
class OrdenController extends Controller
{

   

    public function returnViewFacturasView()
    {
    $facturas = Auth::user()->ordenes()->get();
    return view('user.viewOrden',compact('facturas'));
    }

    public function returnViewFactura($id)
    {
        $factura = Factura::find($id);
        $data = $factura->id;
        return view('user.viewRecentFactura')
            ->with(compact('factura'))
            ->with(compact('data'));
    }


    public function searchProductsUser(Request $request)
    {
        $ordenes = Orden::where('orden','like','%'.$busqueda.'orden%')->get()->first();

        return ;
        
       
   

}

public function buscarOrden(Request $request)
{
    $busqueda = $request->input('search');
    $facturas = Orden::where('cliente','like','%'.$busqueda.'%')
    ->orWhere('id','like','%'.$busqueda.'%')->get();
    return view('user.viewOrden',compact('facturas'));
}

}