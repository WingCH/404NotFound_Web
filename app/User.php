<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Project as ProjectEloquent;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function project(){//創立project的人
        return $this->belongsTo(ProjectEloquent::class); 
        //user.id <=> projects.user_id
    }
}
