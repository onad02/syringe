<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register'])->name('register');
Route::get('/countries', [App\Http\Controllers\API\AuthController::class, 'countryData'])->name('country-data');
Route::get('/city', [App\Http\Controllers\API\AuthController::class, 'cityData'])->name('city-data');
Route::get('/town', [App\Http\Controllers\API\AuthController::class, 'townData'])->name('town-data');
Route::get('/skills', [App\Http\Controllers\API\AuthController::class, 'skillsData'])->name('skills-data');

Route::get('/site-data', [App\Http\Controllers\API\HomeController::class, 'siteData'])->name('site-data');
Route::get('/home-data', [App\Http\Controllers\API\HomeController::class, 'homeData'])->name('home-data');