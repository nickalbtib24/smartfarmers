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

   

    public function returnViewOrdenesView()
    {
        $ordenes = Auth::user()->ordenes()->get();
        return view('user.viewOrdenes',compact('ordenes'));
    }

    public function returnViewOrden($id)
    {
        $orden = Orden::find($id);
        $data = $orden->id;
        return view('user.viewRecentOrder')
            ->with(compact('orden'))
            ->with(compact('data'));
    }
    public function buscarOrden(Request $request)
    {
        $busqueda = $request->input('search');
        $user = Auth::user();
        $ordenesTodas = Orden::where('user_id',$user->id)->get();
        $ordenes = [];
        foreach($ordenesTodas as $orden)
        {
            if($orden->id == $busqueda || $orden->user->name == $busqueda || $orden->producto->nombre == $busqueda)
            {
                $ordenes[] = $orden;
            }
        }
        return view('user.viewOrdenes',compact('ordenes'));
    }

}