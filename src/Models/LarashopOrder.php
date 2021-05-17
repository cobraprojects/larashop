<?php

namespace CobraProjects\LaraShop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LarashopOrder extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relations
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function shippingAddress()
    {
        return $this->belongsTo(LarashopAddress::class, 'larashop_address_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(LarashopOrderDetails::class, 'larashop_order_id', 'id');
    }

    // attributes
    public function getTotalPriceAttribute()
    {
        return $this->price + $this->shipping_cost + $this->payment_fee - $this->coupon_discount;
    }

    public function getAddressAttribute()
    {
        return  $this->shippingAddress->address ?? $this->attributes['address'];
    }

    public function getNotesAttribute()
    {
        return  $this->shippingAddress->notes ?? $this->attributes['notes'];
    }

    public function getFirstNameAttribute()
    {
        return Str::of($this->user->name)->explode(' ')->first() ?? $this->attributes['first_name'];
    }

    public function getLastNameAttribute()
    {
        return Str::of($this->user->name)->explode(' ')->last() ?? $this->attributes['last_name'];
    }

    public function getFullNameAttribute()
    {
        return $this->user->name ?? $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getCityAttribute()
    {
        return $this->user->shippingAddress->city->name ?? $this->attributes['city'];
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? $this->attributes['email'];
    }

    public function getPhoneAttribute()
    {
        return $this->shippingAddress->phone ?? $this->attributes['phone'];
    }

    public function getPostcodeAttribute()
    {
        return $this->shippingAddress->postcode ?? $this->attributes['postcode'];
    }


    public function getPaymentMethodAttribute()
    {
        return config('larashop.paymentMethods')[$this->payment_type];
    }
}
