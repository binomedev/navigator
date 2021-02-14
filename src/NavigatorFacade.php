<?php

namespace Binomedev\Navigator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Binomedev\Navigator\Navigator
 */
class NavigatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Navigator::class;
    }
}
