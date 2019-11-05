<?php

namespace Tests\Feature\Api;

use App\Repositories\CachingWeatherRepository;
use App\Services\WeatherAdapter;
use App\Wind;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use \Mockery;

class WindRouteTest extends TestCase
{
    /**
     * Wind route test.
     *
     * @test
     * @return void
     */
    public function wind_route_test()
    {
        // Build mock model
        $data = new \stdClass;
        $data->speed = 8.2;
        $data->deg = 340;
        $data->gust = 11.3;
        $model = Wind::loadData($data);

        // Setup Cache mock
        Cache::shouldReceive('remember')
            ->once()
            ->andReturn($model);

        // Register adapter mock
        $this->mock(WeatherAdapter::class)
            ->allows([
                'loadWeather' => Mockery::self(),
                'getWind' => $model
            ]);

        // Call API endpoint
        $response = $this->get('/api/v1/wind/84070');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
            'speed' => 8.2,
            'deg' => 340,
            'gust' => 11.3,
            'direction' => "NNW"
        ]);
    }

    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
}
