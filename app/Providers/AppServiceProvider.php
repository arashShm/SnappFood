<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }



    public function boot(): void
    {


        //Blade if statements
        Blade::if('admins', function () {
            return auth()->check() && (auth()->user()->checking('admin')) || (auth()->user()->checking('shop'));
        });

        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->checking('admin');
        });

        Blade::if('shop', function () {
            return auth()->check() && auth()->user()->checking('shop');
        });

        Blade::if('user', function () {
            return auth()->check() && auth()->user()->checking('user');
        });


        //using bootstrap instead of Tailwind css
        // dd(request()->path());
        if(str_starts_with(request()->path(), "public")){
            Paginator::useBootstrapFive();
        }
    }
}
