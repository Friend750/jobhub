<?php

use App\Livewire\Chat;
use App\Livewire\ChatAndFeed;
use App\Livewire\Dashboard\UsersTable;
use App\Livewire\PostCard;

use App\Livewire\UserProfile;

use App\Livewire\CompanyList;
use App\Livewire\CompanyProfile;
use App\Livewire\Dashboard\Dashboard;
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
use App\Livewire\Dashboard\JobsTable;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

// Publicly accessible routes
Route::get('/', HomePage::class)->name("home");
Route::get('/unauthorized-access', function () {
    return view('unauthorized'); // Use a clearer view name
})->name('error');
Auth::routes();

// Secured routes: Only accessible to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/users/{id}/ping', function ($id) {
    $user = User::findOrFail($id);

    Log::info('Ping request for user:', ['user' => $user]);
    // التحقق من أن المستخدم لم يزر الصفحة من قبل
    $viewedUsers = session()->get('viewed_users', []);

    if (!in_array(Auth::user()->id, $viewedUsers)) {
        // زيادة عدد المشاهدات
        $user->increment('views');

        // تخزين المعرف في الجلسة لمنع التكرار
        session()->push('viewed_users', Auth::user()->id);
    }

    return response()->noContent(); // لا تحتاج إلى محتوى
});
    Route::get('/typeaccount', Typeaccount::class)->name("typeaccount");
    Route::get('/interests', SelectInterests::class)->name("interests");
    Route::get('/Followers', FollowersScreen::class)->name("FollowersScreen");
    Route::get('/CompaniesList', CompanyList::class)->name("CompaniesScreen");
    Route::get('/Following', FollowingScreen::class)->name("FollowingsScreen");
    Route::get('/user-profile/{id?}', UserProfile::class)->name("user-profile");
    Route::get('/JobScreen', JobScreen::class)->name("jobScreen");
    Route::get('/Search', Search::class)->name("search");
    Route::get('/EnhanceProfile', EnhanceProfile::class)->name("EnhanceProfile");
    Route::get('/posts', PostCard::class)->name("post");
    Route::get('/chat/{conversationId?}', Chat::class)->name("chat");
    Route::get('/notifications', Notifications::class)->name("notifications");
});

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/users-table', UsersTable::class)->name("users-table");
    Route::get('/jobs-table', JobsTable::class)->name('dashboard.jobs-table');
});

