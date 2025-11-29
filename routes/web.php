<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

// Route::get('/', function () {
//     return view('layouts/index');
// });
// Route::get('/register', function () {
//     return view('layouts/register');
// });
// Route::get('/dash', function () {
//     return view('layouts/dash');
// });

// To view register page
Route::get('/' , [BlogController::class, 'create'])->name('blog.create');
//Fetch Data From register page
Route::post('/' , [BlogController::class, 'register'])->name('blog.register');


Route::get('/dash' , [BlogController::class, 'dashboard'])->middleware('auth')->name('blog.dashboard');

// To view Login page
Route::get('/login' , [BlogController::class, 'showLogin'])->name('login');
//Fetch Data From Login page
Route::post('/login' , [BlogController::class, 'login'])->name('blog.login');

// To logout
Route::post('/logout' , [BlogController::class, 'logout'])->name('blog.logout');


// To view Edit page
Route::get('/update' , [BlogController::class, 'showUpdate'])->middleware('auth')->name('blog.showupdate');
//Insert Data In Edit page
Route::post('/update' , [BlogController::class, 'update'])->middleware('auth')->name('blog.update');


Route::get('/blog' , function(){
    return view('layouts/blogs/index');
});
