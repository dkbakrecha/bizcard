<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

	public function card() {
        return $this->belongsTo('App\Card', 'card_id')
                        ->select(["id", "business_name", "business_person", "contact_primary", "slug"]);
    }
 
}