<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'business_category';

    protected $fillable = [
        'name'
    ];
    
    /*public function services() {
        return $this->hasMany('App\Card', 'card_id');
    }*/
    
    
}