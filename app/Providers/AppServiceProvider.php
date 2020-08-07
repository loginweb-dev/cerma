<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;
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
    }
}
