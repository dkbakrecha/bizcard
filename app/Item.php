<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use App\Notifications\ResetPassword as ResetPasswordNotification;

class Item extends Authenticatable {

    use Notifiable;

    /**
     * Status 
     * 0 = blocked / inactive
     * 1 = active
     * 3 = pending
     */
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_name', 'price', 'description', 'image', 'search_words', 'card_id', 'status','slug','sku','quantity','sale_price','featured'
    ];


    public function setNameAttribute($value)
    {
        $this->attributes['item_name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

}