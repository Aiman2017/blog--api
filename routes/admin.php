<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/blog/my-post', [AdminController::class, 'myPost'])->name('my-post');
    Route::resource('blog', AdminController::class);
});
