<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;
class Categoria extends Model
{
    public function Productos()
    {
        $this->hasMany(Producto::class);
    }
}
