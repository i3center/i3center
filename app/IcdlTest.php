<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcdlTest extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();
    }
}
