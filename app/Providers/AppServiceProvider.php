<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addAction(\App\Actions\Roles::class);

        Voyager::addAction(\App\Actions\Blocks::class);
        Voyager::addAction(\App\Actions\BlockEdit::class);
        Voyager::addAction(\App\Actions\Block::class);
        //accion para los planes de cuentas
        Voyager::addAction(\App\Actions\PlanOfAccount::class);
        Schema::defaultStringLength(191);
    }
}
