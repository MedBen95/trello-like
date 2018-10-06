<?php

namespace App\Providers;

use App\Board;
use App\Http\Repositories\BoardRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    /**
     * AppServiceProvider constructor.
     * @param $boardRepository
     */

    /**
     * AppServiceProvider constructor.
     * @param $boardRepository
     */


    public function boot()
    {


        View::composer('*', function ($view) {

            $user=Auth::user();

            if(!empty($user)){

              $boards=$user->boards;
              $view->with('boards', $boards);

            }

        });

        View::composer('*', function ($view) {

            $user=Auth::user();
            $view->with('user', $user);

            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
