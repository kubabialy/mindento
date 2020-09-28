<?php

namespace App\Providers;

use App\Repositories\User\InMemoryRepository as UserInMemoryRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Delegation\InMemoryRepository as DelegationInMemoryRepository;
use App\Repositories\Delegation\DelegationRepository;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, fn() => new UserInMemoryRepository());
        $this->app->bind(DelegationRepository::class, fn() => new DelegationInMemoryRepository());
    }
}
