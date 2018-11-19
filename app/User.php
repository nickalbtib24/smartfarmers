<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Catalogo;
use App\Factura;
use App\Producto;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','telefono','direccion','genero','esta_activo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_users');
    }

    public function catalogo()
    {
        return $this->hasOne(Catalogo::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }

    

    public function tieneAlgunRol($roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($this->tieneRol($role))
                {
                    return true;
                }
            }
        } else
        {
            if($this->tieneRol($roles))
            {
                return true;
            }
        }
    }

    public function tieneRol($role)
    {
        if($this->roles()->where('name',$role)->first())
        {
            return true;
        }else
        {
            return false;
        }
    }


}
