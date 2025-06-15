<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\Roles;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        Gate::define('schedule-class', function (User $user) {
            return $user->role === Roles::INSTRUCTOR;
        });
    }
}
