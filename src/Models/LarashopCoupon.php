<?php

namespace CobraProjects\LaraShop\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class LarashopCoupon extends Model
{
    protected $guarded = ['categories', 'users', 'products'];

    public function getDataAttribute($value)
    {
        return Str::of($value)->explode(',')->toArray();
    }
}
