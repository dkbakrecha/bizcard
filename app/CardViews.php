<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class CardViews extends \Eloquent {

    protected $table = 'card_views';

    public static function createViewLog($card) {
            $postsViews= new CardViews();
            $postsViews->card_id = $card->id;
            $postsViews->titleslug = $card->slug;
            $postsViews->url = \Request::url();
            $postsViews->session_id = \Request::getSession()->getId();
            $postsViews->user_id = (!empty(Auth::user()->id)?Auth::user()->id:0);
            $postsViews->ip = \Request::getClientIp();
            $postsViews->agent = \Request::header('User-Agent');
            $postsViews->save();
    }

}