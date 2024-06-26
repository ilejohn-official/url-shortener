<?php

use App\Http\Controllers\UrlController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::controller(UrlController::class)->group(function () {
    Route::get('/url-shortener', 'edit')->name('url.edit');
    Route::post('/url-shortener', 'shorten')->name('url.shorten');
    Route::get('/{hash:short_url_hash}', 'redirect')->whereAlphaNumeric('hash')->name('url.redirect');

    //Add any folder structure as prefix and the short url would work!
    Route::prefix('something')->group(function () {
        Route::get('/{hash:short_url_hash}', 'redirect')->whereAlphaNumeric('hash')->name('url.something.redirect');
    });
});
