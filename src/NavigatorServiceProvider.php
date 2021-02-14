<?php

namespace Binomedev\Navigator;

use Illuminate\Contracts\Support\DeferrableProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NavigatorServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('navigator')
            ->hasConfigFile()
            ->hasViews()
            //->hasMigration('create_navigator_table')
            //->hasCommand(NavigatorCommand::class);
        ;
    }

    public function packageRegistered()
    {
        $this->app->singleton(Navigator::class);
    }


    function provides(){
        return [Navigator::class];
    }

}
