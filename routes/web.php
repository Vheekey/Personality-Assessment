<?php

use App\Http\Controllers\AssessmentController;
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

Route::controller(AssessmentController::class)->group(function(){
    Route::get('/', 'index');
    Route::post('/calculate', 'calculatePersonality')->name('personality.calculate');
});
