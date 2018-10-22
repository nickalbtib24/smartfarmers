<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{

    private $name = 'name';

    

    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'role_users');
    }

    public function getName()
    {
        return 'Administrator';
    }
}
