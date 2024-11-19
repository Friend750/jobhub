<?php

use App\Livewire\UserProfile;

use App\Livewire\CompanyList;
use App\Livewire\EnhanceProfile;
use App\Livewire\FollowersScreen;
use App\Livewire\FollowingScreen;
use App\Livewire\HomePage;
use App\Livewire\JobScreen;
use App\Livewire\Notifications;
use App\Livewire\SelectInterests;
use App\Livewire\Typeaccount;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('/',function() {
    return view('welcome');
});

Route::get('/',EnhanceProfile::class);
Route::get('/Followers',FollowersScreen::class)->name("FollowersScreen");
Route::get('/CompaniesList',CompanyList::class)->name("CompaniesScreen");
Route::get('/Following',FollowingScreen::class)->name("FollowingsScreen");

Auth::routes();


