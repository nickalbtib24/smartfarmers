<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categoria;
use App\Catalogo;
use App\Factura;
class Producto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','precio','descripcion','imagen',
    ];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id','categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_id'); 
    }

    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class,'catalogos_producto');
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class,'facturas_producto');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }
}
