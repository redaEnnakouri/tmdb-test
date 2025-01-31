<?php

use App\Http\Controllers\Inertia\Film\FilmController;
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
    return redirect()->route('login');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('films')->name('films.')
        ->controller(FilmController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::prefix('{film}')->group(function () {
                Route::get('show', 'show')->name('show');
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::delete('destroy', 'destroy')->name('destroy');
            });
        });
});


