<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Producto;
class Catalogo extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
