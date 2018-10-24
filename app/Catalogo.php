<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Producto;
class Catalogo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
    ];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'id','user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class,'catalogos_producto');
    }
}
