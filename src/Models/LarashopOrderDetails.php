<?php

namespace CobraProjects\LaraShop\Models;

use Illuminate\Database\Eloquent\Model;

class LarashopOrderDetails extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(LarashopOrder::class, 'larashop_order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(LarashopProduct::class, 'larashop_product_id', 'id');
    }
}
