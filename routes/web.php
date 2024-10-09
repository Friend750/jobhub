<?php

use App\Livewire\HomePage;
use App\Livewire\NavigationBar;
use App\Livewire\Notifications;
use App\Livewire\Search;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
//
// Route::get('/',HomePage::class);
Route::get('/',Search::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
