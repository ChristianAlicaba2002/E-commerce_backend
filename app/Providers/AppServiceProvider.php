<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Products\ProductRepository;
use App\Domain\Products\SpecialRepository;
use App\Infrastructure\Persistence\Eloquent\Product\EloquentProductRepository;
use App\Infrastructure\Persistence\Eloquent\Product\EloquentSpecialProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, EloquentProductRepository::class);
        $this->app->bind(SpecialRepository::class, EloquentSpecialProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
