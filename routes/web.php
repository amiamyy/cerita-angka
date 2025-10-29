<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\DatasetController;
use App\Http\Controllers\Admin\StoryController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/cerita', [FrontendController::class, 'stories'])->name('stories');
Route::get('/cerita/{slug}', [FrontendController::class, 'storyDetail'])->name('story.detail');
Route::get('/dataset', [FrontendController::class, 'datasets'])->name('datasets');
Route::get('/dataset/{slug}', [FrontendController::class, 'datasetDetail'])->name('dataset.detail');
Route::get('/tentang', [FrontendController::class, 'about'])->name('about');
Route::get('/halaman/{slug}', [FrontendController::class, 'page'])->name('page');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Pages Management
    Route::resource('pages', PageController::class);
    
    // Datasets Management
    Route::resource('datasets', DatasetController::class);
    
    // Stories Management
    Route::resource('stories', StoryController::class);
});
