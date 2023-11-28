<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Branch;
use App\Models\CFP;
use App\Policies\BranchPolicy;
use App\Policies\CFPPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CFP::class => CFPPolicy::class,
        Branch::class => BranchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
