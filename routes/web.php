<?php

use App\Livewire\Chat;
use App\Livewire\ChatAndFeed;
use App\Livewire\Dashboard\UsersTable;
use App\Livewire\PostCard;

use App\Livewire\CareerAI\AiQuestions;
use App\Livewire\CareerAI\GenerateQuestines;
use App\Livewire\CareerAI\Questionnaire;
use App\Livewire\CareerAI\ReportsAnalysis;
use App\Livewire\CareerAI\UplaodJobProfile;

use App\Livewire\CareerAI\Welcome;
use App\Livewire\CareerAI\CongratsAnalys;
use App\Livewire\UserProfile;
use Illuminate\Support\Str;
use App\Livewire\CompanyList;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\EnhanceProfile;
use App\Livewire\FollowersScreen;
use App\Livewire\FollowingScreen;
use App\Livewire\HomePage;
use App\Livewire\NavigationBar;
use App\Livewire\Notifications;
use App\Livewire\Search;
use App\Livewire\SelectInterests;
use App\Livewire\Typeaccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\JobsTable;
use App\Livewire\FollowedList;
use App\Livewire\JobList;
use App\Livewire\OtpVerification;
use App\Livewire\Username;
use App\Models\PersonalDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

// Publicly accessible routes
Route::get('/', HomePage::class)->name("home");
Route::get('/unauthorized-access', function () {
    return view('unauthorized'); // Use a clearer view name
})->name('error');
Auth::routes();

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $fullName = $googleUser->getName();
    $nameParts = explode(' ', trim($fullName));
    $firstName = $nameParts[0] ?? null;
    $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : null;

    // البحث عن المستخدم
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // المستخدم جديد، قم بإنشائه وأعطه user_name = "0"
        $user = User::create([
            'email' => $googleUser->getEmail(),
            'user_name' => "0",
            'user_image' => $googleUser->getAvatar(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(Str::random(16)), // إنشاء كلمة مرور عشوائية مشفرة
            'email_verified_at' => Carbon::now('Asia/Aden')
        ]);

        // إنشاء تفاصيل المستخدم فقط إذا كان جديدًا
        PersonalDetail::create([
            'first_name' => $firstName,
            'last_name' =>  $lastName,
            'user_id' => $user->id,
        ]);
    }

    // تسجيل الدخول مباشرة
    Auth::login($user);

    // إذا كان user_name هو "0"، أعد توجيهه لاختيار اسم المستخدم
    if ($user->user_name === "0") {
        return redirect('/username');
    }

    return redirect('/posts'); // أو أي صفحة رئيسية
});

Route::get('/users/{id}/ping', function ($id) {
    $user = User::findOrFail($id);
    $authUser = auth()->user();

    // Check if there is an authenticated user
    if ($authUser) {
        // Create a unique session key for the visited profile
        $sessionKey = 'visited_profile_' . $authUser->id . '_' . $user->id;

        // If the profile hasn't been visited before, increment the view count and mark it as visited
        if (!session()->has($sessionKey)) {
            $user->increment('views');
            session()->put($sessionKey, true);
        }
    }

    return response()->noContent();
});

// Secured routes: Only accessible to authenticated users
Route::middleware(['auth','hasInterestsAndType','hasUsername','verified'])->group(function () {


    // Route::get('/FollowedList/{id?}/{type?}', FollowedList::class)->name('FollowedList');

    Route::get('/Followers', FollowersScreen::class)->name("FollowersScreen");
    Route::get('/CompaniesList', CompanyList::class)->name("CompaniesScreen");
    Route::get('/Following', FollowingScreen::class)->name("FollowingsScreen");
    Route::get('/user-profile/{id?}', UserProfile::class)->name("user-profile");
    Route::get('/JobList/{id?}', JobList::class)->name("jobList");
    Route::get('/Search', Search::class)->name("search");
    Route::get('/EnhanceProfile', EnhanceProfile::class)->name("EnhanceProfile");
    Route::get('/posts', PostCard::class)->name("post");
    Route::get('/chat/{conversationId?}', Chat::class)->name("chat");
    Route::get('/notifications', Notifications::class)->name("notifications");

Route::get('/welcomeCareerAI', Welcome::class)->name('welcomeCareerAI');
Route::get('/interview_type', GenerateQuestines::class)->name('generateQuestines');
Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
Route::get('/AI_questions', AiQuestions::class)->name('AiQuestions');
Route::get('/Uplaod_Job_Profile', UplaodJobProfile::class)->name('Uplaod_Job_Profile');
Route::get('/ReportsAnalysis', ReportsAnalysis::class)->name('ReportsAnalysis');
Route::get('/cong', CongratsAnalys::class)->name('cong');
});


Route::middleware(['auth','hasUsername','verified'])->group(function () {
    Route::get('/typeaccount', Typeaccount::class)->name("typeaccount");
    Route::get('/interests', SelectInterests::class)->name("interests");
});

Route::get('/username', Username::class)->name("username")->middleware('auth');
Route::get('/otp', OtpVerification::class)->name("verify")->middleware('auth');

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/users-table', UsersTable::class)->name("users-table");
    Route::get('/jobs-table', JobsTable::class)->name('dashboard.jobs-table');
});

