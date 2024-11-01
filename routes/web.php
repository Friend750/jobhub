<?php

use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;

Route::get('/',function() {
    return view('welcome');
});

Route::get('/profile', UserProfile::class);

Auth::routes();

?>
