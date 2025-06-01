<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('ar'); // تبديل اللغة إلى العربية

        View::composer('livewire.navigation-bar', function ($view) {

            $countNotifications = DB::table('notifications')
            ->where('notifiable_id', auth()->id())
            ->where('type', '!=', 'App\\Notifications\\SentMessage')
            ->whereNull('read_at')
            ->where(function ($query) {
                $query->where('type', 'App\\Notifications\\Request')
                      ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.user.id')) != JSON_UNQUOTE(JSON_EXTRACT(data, '$.receiverId'))");
            })
            ->count();




            $view->with('countNotifications', $countNotifications);
        });

        View::composer('*', function ($view) {
            $query = session('searchQuery', ''); // Retrieve the query from the session or default to an empty string
            $view->with('query', $query);
        });

    }
}
