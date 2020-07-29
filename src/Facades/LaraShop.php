<?php

namespace CobraProjects\LaraShop\Facades;

use Illuminate\Support\Facades\Facade;

class LaraShop extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaraShop';
    }
}
