<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;
class Categoria extends Model
{
    public function productos()
    {
       return $this->hasMany(Producto::class);
    }
}
