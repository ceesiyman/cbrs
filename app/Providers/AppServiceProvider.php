<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Work;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

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

        View::composer('*', function ($view) {
            $skills = Cache::remember('all_skills', 60*24, function () {
                return Skill::orderBy('name')->get();
            });
            
            $view->with('skills', $skills);
        });

        View::composer('*', function ($view) {
            $topWorks = Work::where('status', 'completed')
                ->where('assigned', true)
                ->with(['client', 'constructor', 'skills'])
                ->withCount('bids')
                ->withMax('bids', 'bid_amount')
                ->orderByDesc('bids_max_bid_amount')
                ->take(9)
                ->get();
                
            $view->with('topWorks', $topWorks);
        });

        View::composer('*', function ($view) {
            $constructors = User::where('role', 'Constructor')
                ->with(['skills', 'projects', 'works'])
                ->paginate(9);
                
            $view->with('constructors', $constructors);
        });
    }
}
