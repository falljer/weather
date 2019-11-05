<?php

namespace App\Providers;

use App\Interfaces\WeatherAdapterInterface;
use App\Repositories\CachingWeatherRepository;
use App\Repositories\WeatherRepository;
use App\Services\WeatherAdapter;
use App\Interfaces\WeatherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Weather Service Adapter
        $this->app->singleton(WeatherAdapterInterface::class, function () {
            return new WeatherAdapter;
        });

        // Weather Repository
        $this->app->singleton(WeatherRepositoryInterface::class, function() {
            $weatherRepository = new WeatherRepository(new WeatherAdapter);
            $cachingRepository = new CachingWeatherRepository($weatherRepository);
            return $cachingRepository;
        });
    }
}
