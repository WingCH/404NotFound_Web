<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User as UserEloquent;
use \App\Image as ImageEloquent;
use \App\Bug as BugEloquent; 
use \App\Fire as FireEloquent; 


class Project extends Model
{
    //預設table name is "projects"

    public function user(){//創立project的人
        return $this->belongsTo(UserEloquent::class); 
        //project.user_id <=> user.id
    }

    public function image(){
        return $this->belongsTo(ImageEloquent::class); 
        //project.image_id <=> image.id
    }

    public function bug(){
    	return $this->hasMany(BugEloquent::class);
        //bug.id <=>bug.project.id
    }

    public function fire(){
        return $this->hasManyThrough(FireEloquent::class, BugEloquent::class);
        //bug.id <=>bug.project.id
    }


}
