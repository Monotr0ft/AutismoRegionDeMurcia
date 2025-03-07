<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Apartado;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContraseniaCambiada;
use App\Mail\UserCreated;
use App\Mail\UserDeleted;
use App\Mail\UserEdit;

class UserController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/dashboard');
        }
        return view('autismo.user.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            if (!Auth::user()->email_verified_at) {
                Auth::user()->email_verified_at = now();
                Auth::user()->save();
            }
            return redirect('/dashboard');
        }
        return redirect()->back()->withErrors(['error' => 'Usuario o contraseña incorrectos']);
    }

    public function postLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function getCreate()
    {
        Gate::authorize('create', User::class);
        return view('autismo.dashboard.paginas.usuarios.create');
    }

    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $usuarios = User::all();
        return view('autismo.dashboard.paginas.usuarios.index', ['usuarios' => $usuarios]);
    }

    public function show(User $user)
    {
        Gate::authorize('view', $user);
        return view('autismo.dashboard.paginas.usuarios.show', ['user' => $user]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', User::class);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $password = Str::random(10);
        $user->remember_token = Str::random(10);
        $user->code = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user->email)->send(new UserCreated($user, $password));

        return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado correctamente');
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();
        Gate::authorize('update', $user);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }else {
            if ($request->new_password != $request->new_password_confirmation) {
                return redirect()->back()->withErrors(['new_password' => 'Las contraseñas no coinciden']);
            }else {
                $user->password = Hash::make($request->new_password);
                Mail::to($user->email)->send(new ContraseniaCambiada($user));
                $user->save();
                return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
            }
        }
    }

    public function getNotYourself($token)
    {
        $user = User::where('code', $token)->first();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Token inválido']);
        }
        return view('autismo.user.notyourself')->with('token', $token);
    }

    public function reupdate_password(Request $request)
    {
        $user = User::where('code', $request->token)->first();
        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'Token inválido']);
        }
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->withErrors(['password' => 'Las contraseñas no coinciden']);
        }
        $user->password = Hash::make($request->password);
        $user->code = Str::random(10);
        $user->save();
        return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente');
    }

    public function update_name(Request $request)
    {
        $user = Auth::user();
        Gate::authorize('update', $user);
        $user->name = $request->name;
        $user->save();
        return redirect()->back()->with('success', 'Nombre actualizado correctamente');
    }

    public function updatePermission(Request $request) {
        // Validación manual para mejor control
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:admin,asociaciones,noticias,paginas,recursos',
            'status' => 'required|boolean'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        if (!Auth::user()->esJefe()) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado'
            ], 403);
        }
    
        try {
            $columnMap = [
                'admin' => 'administrador',
                'asociaciones' => 'asociaciones',
                'noticias' => 'noticias',
                'paginas' => 'paginas',
                'recursos' => 'recursos'
            ];
    
            Apartado::updateOrCreate(
                ['id_user' => $request->user_id],
                [$columnMap[$request->type] => $request->status]
            );
    
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error del servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getEdit($id)
    {
        $user = Auth::user();
        Gate::authorize('update', $user);
        $anotherUser = User::findOrFail($id);
        return view('autismo.dashboard.paginas.usuarios.edit', ['user' => $anotherUser]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('update', Auth::user());
        $request->validate([
            'razon' => 'required'
        ]);
        $user->name = $request->name;
        if ($request->email) {
            $user->email = $request->email;
            $user->save();
        }
        if ($request->reset) {
            Mail::to($user->email)->send(new ContraseniaCambiada($user));
        }
        $jefe = User::where('is_boss', 1)->first();
        Mail::to($jefe->email)->send(new UserEdit($user, $request->razon, Auth::user()));
        return redirect()->route('dashboard.usuarios')->with('success', 'Usuario actualizado correctamente');   
    }

    public function destroy(Request $request, User $user)
    {
        Gate::authorize('delete', Auth::user());
        $request->validate([
            'razon' => 'required'
        ]);
        $jefe = User::where('is_boss', 1)->first();
        Mail::to($jefe->email)->send(new UserDeleted($user, $request->razon, Auth::user()));
        $user->delete();
        return redirect()->route('dashboard.usuarios')->with('success', 'Usuario eliminado correctamente');
    }
}
