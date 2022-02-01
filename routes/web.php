<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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


Route::name('index.')->prefix('index')->group(function () {
    Route::view('/donee', 'demo' , ['name' => 'done'] );
    Route::middleware(['role:user'])->group(function () {
        Route::resource('/post', PostController::class);
        Route::get('/post/del/{post}' , [PostController::class , 'destroy'])->name('post.delete');
        Route::resource('order' , OrderController::class)->names([
            'create' => 'order.new'         
        ]);
        Route::redirect('/' , 'index/hamza');
        Route::get('cart' , AddToCartController::class);
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
