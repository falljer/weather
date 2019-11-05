<?php

namespace App\Interfaces;

/**
 * Class WeatherInterface
 * @package App\Interfaces
 */
interface WeatherAdapterInterface
{
    /**
     * @param integer $zip
     *
     * @return $this
     */
    public function loadWeather($zip);

    /**
     * @return array
     */
    public function getWind();
}
