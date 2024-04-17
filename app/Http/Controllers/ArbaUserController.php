<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArbaUser;

class ArbaUserController extends Controller
{

    public function getLogin()
    {
        if (Auth::guard('arba')->check()) {
            return redirect('/arba/dashboard');
        }

        return view('arba.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = ArbaUser::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'El correo electrónico proporcionado no coincide con nuestros registros.',
            ]);
        }

        if (Auth::guard('arba')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/arba/dashboard');
        }

        return back()->withErrors([
            'passwod' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('arba')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
