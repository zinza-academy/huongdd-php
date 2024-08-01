<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('admin-ac')->prefix('user')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
        Route::post('/create', [UserController::class, 'store'])->name('user.store');
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::resource('post', PostController::class);

    Route::resource('company', CompanyController::class)->middleware('admin');

    Route::resource('topic', TopicController::class)->middleware('admin');
});

require __DIR__.'/auth.php';
