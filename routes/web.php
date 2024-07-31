<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
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

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('user.view');
    Route::patch('/user/{id}', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/{id}', [PostController::class, 'view'])->name('post.view');
    Route::patch('/post/{id}', [PostController::class, 'store'])->name('post.store');

    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/{id}', [CompanyController::class, 'view'])->name('company.view');
    Route::patch('/company/{id}', [CompanyController::class, 'store'])->name('company.store');

});

require __DIR__.'/auth.php';
