<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function anime()
    {
    	return $this->belongsTo('App\Anime');
    }
}
