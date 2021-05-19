<?php

namespace CobraProjects\LaraShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LarashopPage extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}
