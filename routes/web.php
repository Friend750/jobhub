<?php

<<<<<<< HEAD
use App\Livewire\Chat;
=======
use App\Livewire\PostCard;
>>>>>>> dd2c72dde4d8ad7f21b59177b331b718309c110d
use App\Livewire\UserProfile;

use App\Livewire\CompanyList;
use App\Livewire\EnhanceProfile;
use App\Livewire\FollowersScreen;
use App\Livewire\FollowingScreen;
use App\Livewire\HomePage;
use App\Livewire\JobScreen;
use App\Livewire\Notifications;
<<<<<<< HEAD
use App\Livewire\Register;
=======
use App\Livewire\Search;
>>>>>>> dd2c72dde4d8ad7f21b59177b331b718309c110d
use App\Livewire\SelectInterests;
use App\Livewire\SignIn;
use App\Livewire\Typeaccount;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

// Route::get('/',function() {
//     return view('welcome');
// });

<<<<<<< HEAD
Route::get('/',Chat::class);
Route::get('/Followers',FollowersScreen::class)->name("FollowersScreen");
Route::get('/CompaniesList',CompanyList::class)->name("CompaniesScreen");
Route::get('/Following',FollowingScreen::class)->name("FollowingsScreen");
Route::get('/register',Register::class)->name("register");
Route::get('/login',SignIn::class)->name("login");
Route::get('/typeaccount',Typeaccount::class)->name("typeaccount");
Route::get('/interests',SelectInterests::class)->name("interests");
Route::get('/home',HomePage::class)->name("home");
=======
Route::get('/',Typeaccount::class);
Route::get('/user-profile',UserProfile::class);
Route::get('/JobScreen',JobScreen::class);
Route::get('/Search',Search::class);
Route::get('/EnhanceProfile',EnhanceProfile::class);
Route::get('/Followers',FollowersScreen::class)->name("FollowersScreen");
Route::get('/CompaniesList',CompanyList::class)->name("CompaniesScreen");
Route::get('/Following',FollowingScreen::class)->name("FollowingsScreen");
Route::get('/posts',PostCard::class);

>>>>>>> dd2c72dde4d8ad7f21b59177b331b718309c110d
Auth::routes();


