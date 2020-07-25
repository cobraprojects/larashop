<?php

namespace CobraProjects\LaraShop;

class LaraShop
{
    public static function getPrefix()
    {
        return config('larashop.frontend_prefix');
    }

    public static function getAdminPrefix()
    {
        return config('larashop.backend_prefix');
    }
}
