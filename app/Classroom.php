<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function i3classes()
    {
        return $this->hasMany('App\I3class');
    }
}
