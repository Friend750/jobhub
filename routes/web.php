<?php

use App\Livewire\UserProfile;
use App\Livewire\CompanyList;
use Illuminate\Support\Facades\Route;

Route::get('/',function() {
    return view('welcome');
});

Route::get('/', UserProfile::class);

Auth::routes();

?>
