<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }
}
