<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('isSU', function (User $user) {
            return $user->hakakses === 'SU';
        });
        Gate::define('isKepalaSekolah', function (User $user) {
            return $user->hakakses === 'KepalaSekolah';
        });
        Gate::define('isAdmin', function (User $user) {
            return $user->hakakses === 'Admin';
        });
    
        Gate::define('isGuru', function (User $user) {
            return $user->hakakses === 'Guru';
        });
    
        Gate::define('isSiswa', function (User $user) {
            return $user->hakakses === 'Siswa';
        });
        Gate::define('isKurikulum', function (User $user) {
            return $user->hakakses === 'Kurikulum';
        });
        Gate::define('isNonSiswa', function (User $user) {
            return $user->hakakses === 'NonSiswa';
        });
        Gate::define('isSemua', function (User $user) {
            $allowedRoles = ['KepalaSekolah', 'Admin', 'Guru', 'Kurikulum', 'Siswa', 'NonSiswa'];
            return in_array($user->hakakses, $allowedRoles);
        });
        Gate::define('isAdminKepalaSekolah', function (User $user) {
            $allowedRoles = ['KepalaSekolah', 'Admin'];
            return in_array($user->hakakses, $allowedRoles);
        });
        
    }
}
