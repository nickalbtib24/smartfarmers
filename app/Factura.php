<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Producto;
class Factura extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class,'facturas_producto');
    }
}
