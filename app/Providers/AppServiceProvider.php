<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Work;
use Illuminate\Support\Facades\View;

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
            $recentWorks = Work::latest()
                ->take(6)
                ->get();
            
            $view->with('recentWorks', $recentWorks);
        });
    }
}
