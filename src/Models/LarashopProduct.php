<?php

namespace CobraProjects\LaraShop\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\InteractsWithMedia;

class LarashopProduct extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    //protected $with = ['media', 'parent'];
    //protected $withCount = ['products'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('main')
            ->withResponsiveImages()
            ->singleFile();

        $this
            ->addMediaCollection('images')
            ->withResponsiveImages();

        $this->addMediaConversion('thumb')
            ->width(config('larashop.thumbnails.product.width'))
            ->height(config('larashop.thumbnails.product.height'))
            ->nonOptimized();

        $this->addMediaConversion('medium')
            ->width(config('larashop.medium_images.product.width'))
            ->height(config('larashop.medium_images.product.height'))
            ->nonOptimized();
    }

    public function parent()
    {
        return $this->belongsTo('CobraProjects\LaraShop\Models\LarashopProduct', 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany('CobraProjects\LaraShop\Models\LarashopProduct', 'parent_id', 'id');
    }

    public function larashopCategories()
    {
        return $this->belongsToMany('CobraProjects\LaraShop\Models\LarashopCategory');
    }


    public function getHasChildsAttribute()
    {
        return $this->childs->count();
    }
}