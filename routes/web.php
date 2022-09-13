<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\WorkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [MainController::class, 'index'])->name('main');

Route::group(['prefix' => '/admin-panel'], function (){
    Route::get('/',[AdminController::class, 'index'])->name("admin.index");

    Route::resource('/experience', ExperienceController::class);
    Route::resource('/technology', TechnologyController::class);
    Route::resource('/work', WorkController::class);
});

