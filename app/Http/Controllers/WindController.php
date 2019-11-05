<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherRepositoryInterface;
use Illuminate\Http\JsonResponse;

class WindController extends Controller
{
    /**
     * Display the specified resource
     *
     * @param integer $zip
     * @param WeatherRepositoryInterface $weather
     *
     * @return JsonResponse
     */
    public function show($zip, WeatherRepositoryInterface $weather)
    {
        return response()->json($weather->getByZip($zip));
    }
}
