<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function category() {
        return $this->belongsTo('App\Category', 'business_category')
                        ->select(["id", "name", "slug"]);
    }

    public function contact() 
	{ 
	    return $this->HasMany('App\Contact')->where('status','=', 1); 
	}
}