<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total', 'fecha','cliente', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'producto_id','user_id'
    ];

    protected $table = 'ordenes';

    public function producto()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
