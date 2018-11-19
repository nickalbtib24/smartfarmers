<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Producto;
class Factura extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proveedor', 'fecha', 'total','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class,'facturas_producto');
    }
}
