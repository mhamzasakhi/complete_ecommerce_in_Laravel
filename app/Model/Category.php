<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $casts = [
        'parent_id'  => 'integer',
        'position'   => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childes()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getNameAttribute($name)
    {
        if (auth('admin')->check() || auth('seller')->check()) {
            return $name;
        }

        return $this->translations[0]->value??$name;
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function($query){
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }
}
