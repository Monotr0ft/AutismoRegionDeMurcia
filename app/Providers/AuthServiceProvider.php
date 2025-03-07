<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('gestionar_asociaciones', function ($user) {
            return $user->puedeGestionarAsociaciones() || $user->puedeGestionarTodo();
        });

        Gate::define('gestionar_noticias', function ($user) {
            return $user->puedeGestionarNoticias() || $user->puedeGestionarTodo();
        });

        Gate::define('gestionar_recursos', function ($user) {
            return $user->puedeGestionarRecursos() || $user->puedeGestionarTodo();
        });

        Gate::define('gestionar_paginas', function ($user) {
            return $user->puedeGestionarPaginas() || $user->puedeGestionarTodo();
        });

    }
}
