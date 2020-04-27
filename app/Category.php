<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'business_category';

    protected $fillable = [
        'name','slug','icon'
    ];

    protected $appends = [
        'cardCount'
    ];
    
    public function cards() {
        return $this->hasMany('App\Card', 'business_category');
    }

    public function getCardCountAttribute()
    {
        return $this->cards()->count();
    }
}