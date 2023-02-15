<?php

namespace App\Providers;

use App\Interfaces\LinkInterface;
use App\Interfaces\GameInterface;
use App\Interfaces\RegisterInterface;
use App\Services\LinkService;
use App\Services\GameService;
use App\Services\RegisterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(RegisterInterface::class, RegisterService::class);
        $this->app->bind(LinkInterface::class, LinkService::class);
        $this->app->bind(GameInterface::class, GameService::class);
    }
}
