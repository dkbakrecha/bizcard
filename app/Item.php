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
        'item_name', 'price', 'description', 'image', 'search_words', 'card_id', 'status'
    ];

}