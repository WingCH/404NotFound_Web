<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{

	protected $table = "social_users";

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo(User::class); //User::class 預設table name 系 users
        //效果 => table:SocialUser.user_id(fk) 搵 -> table:users.id(pk)
    }
}
