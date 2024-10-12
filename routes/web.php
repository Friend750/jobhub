<?php

use App\Livewire\HomePage;
use App\Livewire\NavigationBar;
use App\Livewire\Notifications;
use App\Livewire\Register;
use App\Livewire\Search;
use App\Livewire\SignIn;
use App\Livewire\Typeaccount;
use Illuminate\Auth\Events\Login;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
//
// Route::get('/',HomePage::class);
Route::get('/',Notifications::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
