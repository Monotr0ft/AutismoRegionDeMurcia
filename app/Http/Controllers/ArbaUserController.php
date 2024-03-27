<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArbaUserController extends Controller
{

    public function getLogin()
    {
        return view('arba.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('arba')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/arba/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
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
