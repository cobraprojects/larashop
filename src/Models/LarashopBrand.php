<?php

namespace CobraProjects\LaraShop\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LarashopBrand extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['image'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();

        $this->addMediaConversion('thumb')
            ->width(config('larashop.thumbnails.brand.width'))
            ->height(config('larashop.thumbnails.brand.height'))
            ->nonOptimized();
    }

    public function products(): HasMany
    {
        return $this->hasMany(LarashopProduct::class, 'brand_id', 'id');
    }
}
