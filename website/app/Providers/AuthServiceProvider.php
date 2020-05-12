<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
      'App\Auction' => 'App\Policies\AuctionPolicy',
      'App\User' => 'App\Policies\UserPolicy'
=======
      'App\User' => 'App\Policies\UserPolicy',
      'App\Auction' => 'App\Policies\AuctionPolicy'
>>>>>>> admin_auth
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
