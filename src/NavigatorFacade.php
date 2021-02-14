<?php

namespace Binomendev\Navigator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Binomendev\Navigator\Navigator
 */
class NavigatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Navigator::class;
    }
}
