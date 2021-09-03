<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    protected $casts = [

        'product_id' => 'integer',
        'status'     => 'integer',
        'featured'   => 'integer',
        'start_date' => 'date',
        'end_date'   => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function products()
    {
        return $this->hasMany(FlashDealProduct::class, 'flash_deal_id');
    }
}
