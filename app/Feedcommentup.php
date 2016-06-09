<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedcommentup extends Model
{
    public function feedcomment()
    {
        return $this->belongsTo('App\Feedcomment');
    }
}
