<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Socio;

class ArbaUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('arba')->check()) {
            return redirect('/arba/login');
        }

        $user = Auth::guard('arba')->user();

        $socio = Socio::where('user_id', $user->id)->first();

        if ($socio && $socio->acceso_web == 0) {
            return redirect('/arba/login');
        }

        return $next($request);
    }
}
