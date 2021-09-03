<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $casts = [
        'user_id' => 'integer',
        'brand_id' => 'integer',
        'min_qty' => 'integer',
        'published' => 'integer',
        'tax' => 'float',
        'unit_price' => 'float',
        'status' => 'integer',
        'discount' => 'float',
        'current_stock' => 'integer',
        'free_shipping' => 'integer',
        'featured_status' => 'integer',
        'refundable' => 'integer',
        'featured' => 'integer',
        'flash_deal' => 'integer',
        'seller_id' => 'integer',
        'purchase_price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('seller', function ($query) {
            $query->where(['status' => 'approved']);
        })->where(['status' => 1])->orWhere(function ($query){
            $query->where(['added_by'=>'admin','status'=>1]);
        });
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    //
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeStatus($query)
    {
        return $query->where('featured_status', 1);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'seller_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }

    public function rating()
    {
        return $this->hasMany(Review::class)
            ->select(DB::raw('avg(rating) average, product_id'))
            ->groupBy('product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function wish_list()
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    /*public function getNameAttribute($name)
    {
        if (auth('admin')->check() || auth('seller')->check()) {
            return $name;
        }
        return $this->translations[0]->value??$name;
    }*/

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }
}
