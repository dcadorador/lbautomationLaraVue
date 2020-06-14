<?php

namespace App\Providers;

use App\Repositories\Eloquent\InfusionsoftRepository;
use App\Repositories\Interfaces\InfusionsoftInterface;
use Illuminate\Support\ServiceProvider;

class InfusionsoftProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(InfusionsoftInterface::class, InfusionsoftRepository::class);
    }
}
