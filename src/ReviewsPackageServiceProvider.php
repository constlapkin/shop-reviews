<?php

namespace Constlapkin\Reviews;

use Constlapkin\Reviews\Models\Review;
use Constlapkin\Reviews\Observers\ReviewObserver;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Class ReviewsPackageServiceProvider
 *
 * @package Constlapkin\Reviews
 */
class ReviewsPackageServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Review::observe(ReviewObserver::class);

        $this->publishes([
            __DIR__.'/../config/shop-reviews.php' => config_path('shop-reviews.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->registerRoutes();
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/shop-reviews.php', 'shop-reviews');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });
    }

    protected function routeConfiguration(): array
    {
        return [
            'prefix' => config('shop-reviews.api_route_prefix'),
            'middleware' => config('shop-reviews.api_route_middleware'),
        ];
    }
}
