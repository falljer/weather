<?php

namespace App\Interfaces;

use App\Wind;

/**
 * Interface WeatherRepositoryInterface
 * @package App\Interfaces
 */
interface WeatherRepositoryInterface
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param integer $zip
     *
     * @return Wind
     */
    public function getByZip($zip);
}