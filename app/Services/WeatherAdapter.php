<?php

namespace App\Services;

use App\Interfaces\WeatherAdapterInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class WeatherAdapter implements WeatherAdapterInterface
{
    private $_client;
    private $_baseUrl = 'https://samples.openweathermap.org/data/2.5';
    private $_data;
    private $_apiKey;

    public function __construct()
    {
        $this->_client = new Client;
        $this->_apiKey = config('openweathermap.api_key');
    }

    public function loadWeather($zip)
    {
        $response = $this->_client->get($this->_baseUrl . '/weather?zip=' . $zip . '&appid=' . $this->_apiKey)
            ->getBody();
        $this->_data = json_decode($response);
        return $this;
    }

    public function getWind()
    {
        if($this->_data && property_exists($this->_data, 'wind'))
            return $this->_data->wind;

        return null;
    }
}
