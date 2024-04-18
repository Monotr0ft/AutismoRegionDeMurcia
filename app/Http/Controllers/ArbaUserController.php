<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArbaUser;
use App\Models\Socio;

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
        if ($request->dni == 'admin@arba.es') {
            $credentials = [
                'email' => $request->dni,
                'password' => $request->password
            ];
            if (Auth::guard('arba')->attempt($credentials)) {
                return redirect('/arba/dashboard');
            }
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
        $socio = Socio::where('dni', $request->dni)->first();
        if (!$socio) {
            return redirect()->back()->with('error', 'No se ha encontrado ningún socio con ese DNI');
        }
        if (!$socio->user_id) {
            return redirect()->back()->with('error', 'El socio no tiene cuenta de usuario');
        }
        $credentials = [
            'email' => $socio->arbaUser->email,
            'password' => $request->password
        ];
        if (Auth::guard('arba')->attempt($credentials)) {
            return redirect('/arba/dashboard');
        }
        return redirect()->back()->with('error', 'Credenciales incorrectas');   
    }

    public function destroy(Request $request)
    {
        Auth::guard('arba')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
