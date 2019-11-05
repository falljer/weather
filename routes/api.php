<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Weather API Routes
Route::prefix('v1/')->group(function () {
    Route::resource('wind', 'WindController')->only([
        'show'
    ]);

    // TODO: Add additional endpoints as requested
});

// Default (404) route (returns JSON)
Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');