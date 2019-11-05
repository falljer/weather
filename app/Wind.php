<?php

namespace App;

class Wind
{
    /* @var $speed */
    public $speed;

    /* @var $deg */
    public $deg;

    /* @var $gust */
    public $gust;

    /* @var $direction */
    public $direction;

    /**
     * @param $data
     *
     * @return Wind
     */
    public static function loadData($data)
    {
        $model = new self;
        $model->speed = $data->speed;
        $model->deg = $data->deg;
        $model->gust = $data->gust;
        $model->direction = $model->windCardinals($model->deg);

        return $model;
    }

    /**
     * @param $deg
     *
     * @return string
     */
    private function windCardinals($deg) {
        $cardinal = '';
        $angles = [];
        $dir = '';
        $cardinalDirections = array(
            'N' => array(348.75, 360),
            'N2' => array(0, 11.25),
            'NNE' => array(11.25, 33.75),
            'NE' => array(33.75, 56.25),
            'ENE' => array(56.25, 78.75),
            'E' => array(78.75, 101.25),
            'ESE' => array(101.25, 123.75),
            'SE' => array(123.75, 146.25),
            'SSE' => array(146.25, 168.75),
            'S' => array(168.75, 191.25),
            'SSW' => array(191.25, 213.75),
            'SW' => array(213.75, 236.25),
            'WSW' => array(236.25, 258.75),
            'W' => array(258.75, 281.25),
            'WNW' => array(281.25, 303.75),
            'NW' => array(303.75, 326.25),
            'NNW' => array(326.25, 348.75)
        );
        foreach ($cardinalDirections as $dir => $angles) {
            if ($deg >= $angles[0] && $deg < $angles[1]) {
                $cardinal = $dir;
            }
        }
        if ($deg >= $angles[0] && $deg < $angles[1]) {
            $cardinal = str_replace("2", "", $dir);
        }
        return $cardinal;
    }
}