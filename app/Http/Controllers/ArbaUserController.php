<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ArbaUser;
use App\Models\Socio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CambioDeContrasenia;
use App\Mail\RecuperarContrasenia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ArbaUserController extends Controller
{

    public function getLogin()
    {

        if (Auth::guard('arba')->check() && Socio::where('user_id', Auth::guard('arba')->user()->id)->first()->acceso_web == 1) {
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
            return redirect()->back()->withErrors(['error' => 'Credenciales incorrectas']);
        }
        $socio = Socio::where('dni', $request->dni)->first();
        if (!$socio) {
            return redirect()->back()->withErrors(['error' => 'No se ha encontrado ningún socio con ese DNI']);
        }
        if (!$socio->user_id) {
            return redirect()->back()->withErrors(['error' => 'El socio no tiene cuenta de usuario']);
        }
        $credentials = [
            'email' => $socio->arbaUser->email,
            'password' => $request->password
        ];
        if (Auth::guard('arba')->attempt($credentials)) {
            return redirect('/arba/dashboard');
        }
        return redirect()->back()->withErrors(['error' => 'Credenciales incorrectas']);   
    }

    public function destroy(Request $request)
    {
        Auth::guard('arba')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/arba/login');
    }

    public function getUsuario()
    {
        $user = Auth::guard('arba')->user();
        return view('arba.dashboard.usuario', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {

        if (!Hash::check($request->password, Auth::guard('arba')->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'La contraseña actual no es correcta']);
        }

        if ($request->new_password != $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }

        $user = ArbaUser::find(Auth::guard('arba')->user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        $socio = Socio::where('user_id', $user->id)->first();
        Mail::to($socio->email)->send(new CambioDeContrasenia($socio->nombre, $socio->apellido1.' '.$socio->apellido2));

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
    }

    public function getRecuperarContrasenia()
    {
        return view('arba.recuperarcontrasenia');
    }

    public function postRecuperarContrasenia(Request $request)
    {
        $socio = Socio::where('dni', $request->dni)->first();
        if (!$socio) {
            return redirect()->back()->withErrors(['error' => 'No se ha encontrado ningún socio con ese DNI']);
        }
        if (!$socio->user_id) {
            return redirect()->back()->withErrors(['error' => 'El socio no tiene cuenta de usuario']);
        }
        $user = ArbaUser::find($socio->user_id);
        $token = Str::random(64);

        DB::connection('mysql-arba')->table('password_reset_tokens_arba')->where(['email' => $user->email])->delete();

        DB::connection('mysql-arba')->table('password_reset_tokens_arba')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::to($user->email)->send(new RecuperarContrasenia($socio->nombre, $socio->apellido1.' '.$socio->apellido2, $token));

        return redirect()->back()->with('success', 'Se ha enviado un correo electrónico con las instrucciones para recuperar la contraseña');

    }

    public function getResetContrasenia($token)
    {
        $passwordReset = DB::connection('mysql-arba')->table('password_reset_tokens_arba')->where('token', $token)->first();
        if (!$passwordReset) {
            return redirect('/arba/login');
        }
        return view('arba.resetcontrasenia', ['token' => $token]);
    }

    public function postActualizarContrasenia(Request $request, $token)
    {
        $passwordReset = DB::connection('mysql-arba')->table('password_reset_tokens_arba')->where('token', $token)->first();
        $user = ArbaUser::where('email', $passwordReset->email)->first();
        if ($request->new_password != $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        $socio = Socio::where('user_id', $user->id)->first();

        Mail::to($socio->email)->send(new CambioDeContrasenia($socio->nombre, $socio->apellido1.' '.$socio->apellido2));

        DB::connection('mysql-arba')->table('password_reset_tokens_arba')->where('token', $token)->delete();

        return redirect('/arba/login')->with('success', 'Contraseña actualizada correctamente');
    }

}
