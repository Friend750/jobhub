<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\PersonalDetail;

use App\Livewire\{
    Chat,
    ChatAndFeed,
    PostCard,
    CompanyList,
    Dashboard\Dashboard,
    Dashboard\UsersTable,
    Dashboard\JobsTable,
    EnhanceProfile,
    FollowersScreen,
    FollowingScreen,
    FollowedList,
    HomePage,
    NavigationBar,
    Notifications,
    Search,
    SelectInterests,
    Typeaccount,
    OtpVerification,
    Username,
    UserProfile,
    CareerAI\AiQuestions,
    CareerAI\CongratsAnalys,
    CareerAI\GenerateQuestines,
    CareerAI\Questionnaire,
    CareerAI\ReportsAnalysis,
    CareerAI\UplaodJobProfile,
    CareerAI\Welcome,
    GetArticleLink,
    JobList
};

// ----------------------
// 🌐 Public Routes
// ----------------------

// الصفحة الرئيسية
Route::get('/', HomePage::class)->name("home");

// صفحة الوصول غير المصرح بها
Route::get('/unauthorized-access', fn () => view('unauthorized'))->name('error');

// مسارات تسجيل الدخول
Auth::routes();

// تسجيل الدخول عبر Google
Route::get('/auth/google', fn () => Socialite::driver('google')->redirect())->name('google.login');

// عودة من Google بعد التسجيل
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $fullName = $googleUser->getName();
    $nameParts = explode(' ', trim($fullName));
    $firstName = $nameParts[0] ?? null;
    $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : null;

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'email' => $googleUser->getEmail(),
            'user_name' => "0",
            'user_image' => $googleUser->getAvatar(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(Str::random(16)),
            'email_verified_at' => Carbon::now('Asia/Aden')
        ]);

        PersonalDetail::create([
            'first_name' => $firstName,
            'last_name' =>  $lastName,
            'user_id' => $user->id,
        ]);
    }

    Auth::login($user);

    return $user->user_name === "0"
        ? redirect('/username')
        : redirect('/posts');
});

// تتبع الزيارات للملف الشخصي
Route::get('/users/{id}/ping', function ($id) {
    $user = User::findOrFail($id);
    $authUser = auth()->user();

    if ($authUser) {
        $sessionKey = 'visited_profile_' . $authUser->id . '_' . $user->id;
        if (!session()->has($sessionKey)) {
            $user->increment('views');
            session()->put($sessionKey, true);
        }
    }

    return response()->noContent();
});

// ----------------------
// 🔒 Authenticated Routes
// ----------------------

// الوصول إلى صفحة EnhanceProfile
Route::get('/EnhanceProfile', EnhanceProfile::class)
    ->middleware(['auth'])
    ->name("EnhanceProfile");

// مسارات للمستخدمين الذين أكملوا بياناتهم الشخصية
Route::middleware([
    'auth',
    'hasInterestsAndType',
    'hasUsername',
    'verified',
    'enhanced.profile',
    'setLocale'
])->group(function () {
    Route::get('/posts', PostCard::class)->name("post");
    Route::get('/chat/{conversationId?}', Chat::class)->name("chat");
    Route::get('/notifications', Notifications::class)->name("notifications");

    Route::get('/FollowedList/{id?}/{type?}', FollowedList::class)->name('FollowedList');
    Route::get('/Followers', FollowersScreen::class)->name("FollowersScreen");
    Route::get('/CompaniesList', CompanyList::class)->name("CompaniesScreen");
    Route::get('/Following', FollowingScreen::class)->name("FollowingsScreen");
    Route::get('/user-profile/{id?}', UserProfile::class)->name("user-profile");
    Route::get('/JobList/{id?}', JobList::class)->name("jobList");
    Route::get('/JobList/ShowAll/{UserID?}', JobList::class)->name("ShowAllJobs");
    Route::get('/Search', Search::class)->name("search");

    Route::get('/article-link/{id?}', GetArticleLink::class)->name("ArticleLink");
    Route::get('/ShowAllPosts/{UserID?}', GetArticleLink::class)->name("ShowAllPosts");

    // Career AI
    Route::get('/welcomeCareerAI', Welcome::class)->name('welcomeCareerAI');
    Route::get('/interview_type', GenerateQuestines::class)->name('generateQuestines');
    Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
    Route::get('/AI_questions', AiQuestions::class)->name('AiQuestions');
    Route::get('/Uplaod_Job_Profile', UplaodJobProfile::class)->name('Uplaod_Job_Profile');
    Route::get('/ReportsAnalysis', ReportsAnalysis::class)->name('ReportsAnalysis');
    Route::get('/cong', CongratsAnalys::class)->name('cong');


});

// مسارات لإعدادات الحساب مثل اختيار الاهتمامات ونوع الحساب
Route::middleware(['auth', 'hasUsername', 'verified'])->group(function () {
    Route::get('/typeaccount', Typeaccount::class)->name("typeaccount");
    Route::get('/interests', SelectInterests::class)->name("interests");
});

// مسارات لإعداد الاسم وتحقق OTP
Route::get('/username', Username::class)->middleware('auth')->name("username");
Route::get('/otp', OtpVerification::class)->middleware('auth')->name("verify");

// مسارات الإدارة
Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/users-table', UsersTable::class)->name("users-table");
    Route::get('/jobs-table', JobsTable::class)->name('dashboard.jobs-table');
});

// تبديل اللغة بين الإنجليزية والعربية
Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');
