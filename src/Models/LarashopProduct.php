<?php

namespace CobraProjects\LaraShop\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class LarashopProduct extends Model implements HasMedia, Buyable
{
    use InteractsWithMedia;

    protected $guarded = ['categories', 'image', 'images'];

    protected $with = ['media'];
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

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = NULL)
    {
        return 0;
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

    public function getDefaultImageAttribute()
    {
        return $this->getFirstMedia('main');
    }

    public function getDefaultImageThumbAttribute()
    {
        return $this->getFirstMedia('main')('thumb');
    }

    public function getDefaultImageMediumAttribute()
    {
        return $this->getFirstMedia('main')('medium');
    }
}
