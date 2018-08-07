<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User as UserEloquent;
use \App\Project as ProjectEloquent;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(UserEloquent::class);
        //comment.user_id <=> users.id
    }
    public function project()
    {
        return $this->belongsTo(ProjectEloquent::class);
        //comment.project_id <=> projects.id
    }

}
