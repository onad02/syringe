<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

Route::post('login', [App\Http\Controllers\AuthController::class, 'postLogin'])->name('login'); 
Route::post('register', [App\Http\Controllers\AuthController::class, 'postRegistration'])->name('registration');
Route::post('logout', [App\Http\Controllers\AuthController::class, 'postLogout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Clear route cache
 Route::get('/route-cache', function() {
     \Artisan::call('route:cache');
     return 'Routes cache cleared';
 });

 //Clear config cache
 Route::get('/config-cache', function() {
     \Artisan::call('config:cache');
     return 'Config cache cleared';
 }); 

 // Clear application cache
 Route::get('/clear-cache', function() {
     \Artisan::call('cache:clear');
     return 'Application cache cleared';
 });

 // Clear view cache
 Route::get('/view-clear', function() {
     \Artisan::call('view:clear');
     return 'View cache cleared';
 });

 // Clear cache using reoptimized class
 Route::get('/optimize-clear', function() {
     \Artisan::call('optimize:clear');
     return 'View cache cleared';
 });
