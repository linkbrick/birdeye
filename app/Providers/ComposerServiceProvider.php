<?php

namespace App\Providers;

use App\Http\ViewComposers\Navigation;
use App\Http\ViewComposers\ClaimItem;
use App\Http\ViewComposers\Notification;
use App\Http\ViewComposers\PendingApprovalQuotation;
use App\Http\ViewComposers\Profile;
use App\Http\ViewComposers\Task;
use App\Http\ViewComposers\Ticket;
use App\Http\ViewComposers\UpcomingAppointment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.partials._topbar', Navigation::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
