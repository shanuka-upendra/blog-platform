<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/blog', [PostController::class, 'index']);
Route::get('/blog/{post}', [PostController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('posts/{post}/edit',[PostController::class,'edit']);
    Route::put('posts/{post}',[PostController::class,'update']);
    Route::delete('/posts/{post}',[PostController::class,'destroy']);
    Route::get('/my-posts',[PostController::class,'myPosts']);
});

Route::get('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe');

Route::middleware('auth')->group(function () {
    Route::get('/checkout',              [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::get('/subscription/success',  [SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel',   [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/',                            [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users',                       [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/toggle-premium',[AdminController::class, 'togglePremium'])->name('admin.toggle-premium');
    Route::post('/users/{user}/toggle-admin',  [AdminController::class, 'toggleAdmin'])->name('admin.toggle-admin');
    Route::delete('/users/{user}',             [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('/posts',                       [AdminController::class, 'posts'])->name('admin.posts');
    Route::post('/posts/{post}/toggle',        [AdminController::class, 'togglePost'])->name('admin.toggle-post');
    Route::delete('/posts/{post}',             [AdminController::class, 'deletePost'])->name('admin.delete-post');
});

require __DIR__ . '/auth.php';
