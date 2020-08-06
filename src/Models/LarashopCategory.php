<?php

namespace CobraProjects\LaraShop\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class LarashopCategory extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    //protected $with = ['media', 'parent'];
    //protected $withCount = ['products'];

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

    public function parent()
    {
        return $this->belongsTo('CobraProjects\LaraShop\Models\LarashopCategory', 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany('CobraProjects\LaraShop\Models\LarashopCategory', 'parent_id', 'id');
    }

    public function larashopProducts()
    {
        return $this->belongsToMany('CobraProjects\LaraShop\Models\LarashopProduct');
    }

    public function getHasChildsAttribute()
    {
        return $this->childs->count();
    }
}
