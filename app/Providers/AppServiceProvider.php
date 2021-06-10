<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\AdminNotifications;
use Illuminate\View\View as ViewView;
use App\UserNotifications;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('main', function (ViewView $view) {
            $notif = AdminNotifications::where('read_at', null)->orderBy('created_at','desc')->limit(5)->get();
            $view->with('notif',$notif);
            // dd($notif);
        });

        view()->composer('user-layout', function (ViewView $view) {
            // $notif = UserNotifications::where('notifiable_id', Auth::user()->id)->get();
            $notif = UserNotifications::where('read_at', null)->orderBy('created_at','desc')->limit(5);

            if(Auth::check() == 1){
                $notif = $notif->where('notifiable_id', Auth::user()->id )->get();
                $view->with('notif',$notif);
            }
            if(Auth::check() == 0){
                $notif = UserNotifications::where('read_at', null)->orderBy('created_at','desc')->limit(5)->get();
                $view->with('notif',$notif);
            }
        });
    }
}
