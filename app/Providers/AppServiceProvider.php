<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // REPOSITORIES
        $this->app->bind("App\Http\Repositories\Interfaces\UserRepositoryInterface", "App\Http\Repositories\UserRepository");
        $this->app->bind("App\Http\Repositories\Interfaces\RoleRepositoryInterface", "App\Http\Repositories\RoleRepository");
        $this->app->bind("App\Http\Repositories\Interfaces\ExpenseRepositoryInterface", "App\Http\Repositories\ExpenseRepository");  
        $this->app->bind("App\Http\Repositories\Interfaces\ExpenseCategoryRepositoryInterface", "App\Http\Repositories\ExpenseCategoryRepository");    
            
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
