<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PostsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

//=========================================================================================

//AllUser POSTs PAGE 
Route::middleware(['auth', 'verified'])->group(function () {
    //AllUser MAIN PAGE 
    Route::get('/dashboard', [PostsController::class, 'index'])->name('dashboard');
    Route::get('/my-post', [PostsController::class, 'myPosts'])->name('my-post');
    Route::get('/search', [PostsController::class, 'search'])->name('posts.search');

    //AllUser ADD POST PAGE
    Route::get('/create-post', [PostsController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

    //AllUser SHOW SINGLE POST PAGE
    Route::get('/dashboard/post/{id?}', [PostsController::class, 'show'])->name('post.show');
    
    //AllUser UPDATE & DELETE POST PAGE
    Route::get('/edit-post/{id}', [PostsController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{id}', [PostsController::class, 'update'])->name('post.update');
    Route::delete('/posts/{id}', [PostsController::class, 'remove'])->name('post.remove');

    //OnlyAdmin CRUD PAGE
    Route::get('/admin', [PostsController::class, 'trashed'])->name('admin');
    Route::get('/admin/{id}', [PostsController::class, 'restore'])->name('admin.restore');
    Route::delete('/admin/{id}', [PostsController::class, 'destroy'])->name('admin.delete');
});

//===================================================================================================

//Route::resource('posts', PostController::class)->middleware('auth');
