<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Socio;

class AdministracionArbaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('arba')->user();

        $socio = Socio::where('user_id', $user->id)->first();

        if ($socio && $socio->administracion == 0) {
            return redirect('/arba/dashboard');
        }

        return $next($request);
    }
}
