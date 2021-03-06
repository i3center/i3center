<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function parent()
    {
        return $this->belongsTo('App\Menu','parent_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Menu','parent_id');
    }
}
