<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Abilities

        $gate->define('studentdata-showprivate', function ($user, $studentData) {
            if (!is_object($studentData)) {
                $studentData = ['nim' => (integer) $studentData];
            }
            return $user['nim'] === $studentData['nim'] || $user->hasRole('studentdata-showprivate-all');
        });

        $gate->define('studentdata-edit', function ($user, $studentData) {
            if (!is_object($studentData)) {
                $studentData = ['nim' => (integer) $studentData];
            }
            return $user['nim'] === $studentData['nim'] || $user->hasRole('studentdata-edit-all');
        });
    }
}
