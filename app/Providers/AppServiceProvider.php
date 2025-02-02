<?php

namespace App\Providers;

use App\Domain\Products\ProductRepository;
use App\Infrastructure\Persistence\Eloquent\Product\EloquentProductRepository;
use App\Infrastructure\Persistence\Eloquent\Product\EloquentSpecialProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, EloquentSpecialProductRepository::class);
        $this->app->bind(\App\Domain\Branches\BranchRepository::class, \App\Infrastructure\Persistence\Eloquent\Admin\EloquentBranchRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
