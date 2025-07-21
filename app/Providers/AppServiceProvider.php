<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Reminder;
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
        View::composer('*', function ($view) {
            $today = Carbon::today();
            $reminders = Reminder::whereDate('remind_at', '<=', $today)
                ->where('is_sent', false)
                ->orderBy('remind_at', 'desc')
                ->get();

            $view->with('reminderNotifications', $reminders);
        });
    }
}
