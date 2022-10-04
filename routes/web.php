<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Post\PostTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\RegisteredUser;
use App\Http\Controllers\Admin\UserFullDataController;

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

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('about/',[AboutController::class, 'index'])->name('about');

Route::resource('category',CategoryController::class);

Route::resource('post-type',PostTypeController::class);

Route::group(['middleware' => 'guest'], function (){
    Route::get('register',[RegisteredUser::class,'create'])->name('registerUser.create');
    Route::post('register',[RegisteredUser::class,'store'])->name('registerUser.store');
    Route::get('login', [AuthUserController::class,'create'])->name('login.create');
    Route::post('login', [AuthUserController::class,'store'])->name('login.store');
});

Route::get('logout', [AuthUserController::class,'logout'])->name('logout')->middleware('auth');

Route::group(['prefix' => '/admin-panel', 'middleware' => 'auth'], function (){
    Route::get('/',[AdminController::class, 'index'])->name("admin.index");

    Route::resource('/experience', ExperienceController::class);

    Route::resource('/user-full-data', UserFullDataController::class);

    Route::get('/experience/sorting/{id}',
        [ExperienceController::class, 'sortingTechnologies'])->name('experience.sortingTechnologies');
    Route::post('/experience/sorting/{id}',
        [ExperienceController::class, 'sortingTechnologiesUpdate'])->name('experience.sortingTechnologiesUpdate');
    Route::get('/experience/sorting-works/{id}',
        [ExperienceController::class, 'sortingWorks'])->name('experience.sortingWorks');
    Route::post('/experience/sorting-works/{id}',
        [ExperienceController::class, 'sortingWorksUpdate'])->name('experience.sortingWorksUpdate');

    Route::resource('/technology', TechnologyController::class);
    Route::resource('/work', WorkController::class);
});

