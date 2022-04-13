<?php

use App\Http\Controllers\AssessmentControllerStep1;
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

Route::get('/', function(){
    return redirect('assessment/personality');
});


Route::multistep('assessment/personality', 'App\Http\Controllers\AssessmentController')
    ->steps(5)
    ->name('assessment.register');
