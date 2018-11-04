<?php

namespace App\Http\Controllers;

use App\Factura;
use App\User;
use App\Orden;
use App\Producto;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }

    public function returnViewFacturasView()
    {
        $facturas = Factura::where('user_id',Auth::user()->id)->get();
        return view('user.viewFacturas')
        ->with(compact('facturas'));
    }

    public function returnViewFactura($id)
    {
        $factura = Factura::find($id);
        $data = $factura->id;
        return view('user.viewRecentFactura')
            ->with(compact('factura'))
            ->with(compact('data'));
    }

    public function getPaymentInformation(Request $request)
    {
        $transactionState = $request->input('transactionState');
        if($transactionState === '4')
        {
            $data = $request->input('referenceCode');
            
            $information=explode("-",$data);

            $user = Auth::user();
            
            $producto = Producto::find($information[1]);

            $factura = Factura::create([
                'proveedor' => $information[2],
                'fecha' => Carbon::now()->toDateTimeString(),
                'total' => $request->input('TX_VALUE'),
            ]);

            $factura->user()->associate($user);
            $factura->productos()->attach($producto);
            

            $proveedor = User::where('name',$information[2])->get()->first();
            $orden = Orden::create([
                'total' => $request->input('TX_VALUE'),
                'fecha' => Carbon::now()->toDateTimeString(),
                'cliente' => $user->name,
            ]);

            $orden->user()->associate($proveedor);
            $orden->producto()->associate($producto);
            
            $factura->save();
            $user->save();
            $producto->save();
            $orden->save();
            return view('user.viewRecentFactura')
            ->with(compact('factura'))
            ->with(compact('data'));
        }
    }
}
