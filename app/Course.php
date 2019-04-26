<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function i3classes()
    {
        return $this->hasMany('App\I3class');
    }

    public function group()
    {
        return $this->belongsTo('App\Group')->withDefault();
    }
}
