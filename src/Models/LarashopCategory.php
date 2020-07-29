<?php

namespace CobraProjects\LaraShop\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class LarashopCategory extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->withResponsiveImages()
            ->singleFile();

        $this->addMediaConversion('thumb')
            ->width(config('larashop.thumbnails.category.width'))
            ->height(config('larashop.thumbnails.category.height'))
            ->nonOptimized();

        $this->addMediaConversion('medium')
            ->width(config('larashop.medium_images.category.width'))
            ->height(config('larashop.medium_images.category.height'))
            ->nonOptimized();
    }
}
