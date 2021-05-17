<?php

namespace CobraProjects\LaraShop\Models;

use Illuminate\Database\Eloquent\Model;

class LarashopAddress extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function city()
    {
        return $this->belongsTo(LarashopCity::class, 'larashop_city_id', 'id');
    }
}
