<?php

namespace App\Providers;

use App\Auction;
use App\Policies\AuctionPolicy;
use App\Policies\ReportPolicy;
use App\Policies\UserPolicy;
use App\Report;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      User::class => UserPolicy::class,
      Auction::class => AuctionPolicy::class,
      Report::class => ReportPolicy::class,
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
