<?php

namespace App\Repositories;

use App\Interfaces\WeatherRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CachingWeatherRepository implements WeatherRepositoryInterface
{
    /* @var $weatherRepository */
    protected $weatherRepository;

    /* @var $ttl */
    protected $ttl = 15;

    /**
     * CachingWeatherRepository constructor.
     *
     * @param WeatherRepositoryInterface $weatherRepository
     */
    public function __construct(WeatherRepositoryInterface $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->weatherRepository->all();
    }

    /**
     * Get Wind by Zip Code
     *
     * @param int $zip
     *
     * @return \App\Wind
     */
    public function getByZip($zip)
    {
        return Cache::remember('weather.getwindbyzip', $this->ttl, function() use ($zip) {
            return $this->weatherRepository->getByZip($zip);
        });
    }
}