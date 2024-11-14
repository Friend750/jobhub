<?php

use App\Livewire\UserProfile;

use App\Livewire\CompanyList;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('/',function() {
    return view('welcome');
});

Route::get('/', CompanyList::class);

Auth::routes();


