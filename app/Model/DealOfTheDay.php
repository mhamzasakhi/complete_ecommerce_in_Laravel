<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DealOfTheDay extends Model
{
    protected $casts = [
        'discount'   => 'float',
        'product_id' => 'integer',
        'status'     => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
