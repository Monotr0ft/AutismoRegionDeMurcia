<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $value,
            ]);

            return $response->json()['success'];
        });
    }
}
