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

    //AllUser ADD POST PAGE
    Route::get('/create-post', [PostsController::class, 'create'])->name('create-post');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

    //AllUser SHOW SINGLE POST PAGE
    Route::get('/dashboard/post/{id?}', [PostsController::class, 'show'])->name('post.show');
    Route::get('/edit-post/{id}', [PostsController::class, 'edit'])->name('post.edit');
    
    Route::put('/posts/{id}', [PostsController::class, 'update'])->name('post.update');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.destroy');
});

//===================================================================================================

//OnlyAdmin CRUD PAGE
Route::get('/admin', function () {
    return view('admin-page');
})->middleware(['auth', 'verified'])->name('admin');

//Route::resource('posts', PostController::class)->middleware('auth');
