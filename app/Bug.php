<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project as ProjectEloquent;
use App\User as UserEloquent;
use App\Fire as FireEloquent;


class Bug extends Model
{
    //預設table name is "Bugs"
    public function project()
    {
        return $this->belongsTo(ProjectEloquent::class);
        //bug.project_id <=> project.id
    }

    public function user()
    {
        return $this->belongsTo(UserEloquent::class);
        //bug.user_id <=> user.id
    }

    public function fire()
    {
        return $this->hasMany(FireEloquent::class);
        //bug.id <=> fire.bug_id
    }
}
