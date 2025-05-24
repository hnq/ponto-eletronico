<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            // return $user->role === 'admin';
            // return strtolower(trim($user->role)) === 'admin';
            return $user->isAdmin();
        });
    }
}
