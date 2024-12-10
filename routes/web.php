<?php

use App\Livewire\Chat;
use App\Livewire\ChatAndFeed;
use App\Livewire\PostCard;

use App\Livewire\UserProfile;

use App\Livewire\CompanyList;
use App\Livewire\EnhanceProfile;
use App\Livewire\FollowersScreen;
use App\Livewire\FollowingScreen;
use App\Livewire\HomePage;
use App\Livewire\JobScreen;
use App\Livewire\NavigationBar;
use App\Livewire\Notifications;
use App\Livewire\Register;
use App\Livewire\Search;
use App\Livewire\SelectInterests;
use App\Livewire\SignIn;
use App\Livewire\Typeaccount;
use App\Livewire\UserProfileCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/',function() {
//     return view('welcome');
// });


Route::get('/',UserProfileCard::class)->name("route");
Route::get('/Followers',FollowersScreen::class)->name("FollowersScreen");
Route::get('/CompaniesList',CompanyList::class)->name("CompaniesScreen");
Route::get('/Following',FollowingScreen::class)->name("FollowingsScreen");
// Route::get('/register',Register::class)->name("register");
// Route::get('/login',SignIn::class)->name("login");
Route::get('/typeaccount',Typeaccount::class)->name("typeaccount");
Route::get('/interests',SelectInterests::class)->name("interests");
Route::get('/home',HomePage::class)->name("home");
Route::get('/user-profile',UserProfile::class)->name("user-profile");
Route::get('/JobScreen',JobScreen::class)->name("jobScreen");
Route::get('/Search',Search::class)->name("search");
Route::get('/feed',PostCard::class);
Route::get('/EnhanceProfile',EnhanceProfile::class)->name("EnhanceProfile");
Route::get('/posts',PostCard::class)->name("post");
Route::get('/chat',Chat::class)->name("chat");
Route::get('/notifications',Notifications::class)->name("notifications");
Auth::routes();


