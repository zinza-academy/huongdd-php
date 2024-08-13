<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TagController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('admin-ac')->prefix('user')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/create', [UserController::class, 'store'])->name('user.store');
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/deletemany', [UserController::class, 'deleteMany'])->name('user.deletemany');
        Route::patch('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::get('post/search', [PostController::class, 'search'])->name('post.search');
    Route::resource('post', PostController::class);
    Route::post('img/upload', [PostController::class, 'upload'])->name('img.upload');

    Route::resource('company', CompanyController::class)->middleware('admin');

    Route::delete('topic/deletemany', [TopicController::class, 'deleteMany'])->name('topic.deletemany')->middleware('admin');
    Route::get('topic/detail/{id}', [TopicController::class, 'topicDetail'])->name('topic.detail');

    Route::resource('topic', TopicController::class)->middleware('admin');

    Route::delete('tag/deletemany', [TagController::class, 'deleteMany'])->name('tag.deletemany')->middleware('admin');

    Route::resource('tag', TagController::class)->middleware('admin');

});

require __DIR__.'/auth.php';
