<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\BlogPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
//        User::class => BlogPolicy::class
    'App\Models\User' => 'App\Policies\BlogPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('update_post', function ($user) {
            return $user->role->name == 'admin';
        });
        //
    }
}
