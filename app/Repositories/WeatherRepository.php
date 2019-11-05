<?php

namespace App\Repositories;

use App\Services\WeatherAdapter;
use App\Interfaces\WeatherRepositoryInterface;
use App\Wind;

class WeatherRepository implements WeatherRepositoryInterface
{
    /* @var WeatherAdapter */
    protected $weatherAdapter;

    /**
     * WeatherRepository constructor.
     *
     * @param WeatherAdapter $weatherAdapter
     */
    public function __construct(WeatherAdapter $weatherAdapter)
    {
        $this->weatherAdapter = $weatherAdapter;
    }

    /**
     * @return array
     */
    public function all()
    {
        // TODO: Implement all() method.
        return [];
    }

    /**
     * Get Wind by Zip Code
     *
     * @param integer $zip
     *
     * @return Wind
     */
    public function getByZip($zip)
    {
        $windData = $this->weatherAdapter->loadWeather($zip)
            ->getWind();

        return Wind::loadData($windData);
    }
}