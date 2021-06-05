<?php

namespace CobraProjects\LaraShop\Traits;

use CobraProjects\LaraShop\Models\LarashopOrder;

trait Orderable
{
    public function orders()
    {
        return $this->hasMany(LarashopOrder::class);
    }
}
