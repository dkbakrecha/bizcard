<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    /**
     * @var string
     */
    protected $table = 'items_images';

    /**
     * @var array
     */
    protected $fillable = ['item_id', 'thumbnail', 'full'];

    /**
     * @var array
     */
    protected $casts = [
        'item_id'    =>  'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
