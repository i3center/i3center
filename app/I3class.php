<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class I3class extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher')->withDefault();
    }
}
