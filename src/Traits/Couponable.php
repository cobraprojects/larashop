<?php

namespace CobraProjects\LaraShop\Traits;

use CobraProjects\LaraShop\Models\LarashopCoupon;

trait Couponable
{
    public function coupons()
    {
        return $this->morphToMany(LarashopCoupon::class, 'couponable', 'larashop_couponable');
    }

    public function storeCoupon($coupon_id)
    {
        $this->coupons()->attach($coupon_id);
    }

    public function hasUsedCoupon($coupon)
    {
        return $this->coupons->contains($coupon);
    }
}
