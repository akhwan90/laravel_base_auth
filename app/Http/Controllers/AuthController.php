<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function front()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view(env('APP_THEME') . '.register');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view(env('APP_THEME').'.register');
    }

    public function registerStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/register')->with('notif', '<div class="alert alert-success">Registrasi berhasil</div>');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        return view(env('APP_THEME') . '.login');
    }

    public function loginProccess(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'required|min:5',
            'password' => 'required|min:5',
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('notif', '<div class="alert alert-danger">Terjadi kesalahan login</div>')->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

    public function resetPassword()
    {
        return view('page.user.reset_password');
    }

    public function resetPasswordProccess(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('notif', '<div class="alert alert-danger">Password lama salah</div>');
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('notif', '<div class="alert alert-success">Password berhasil diubah</div>');
    }

    public function dashboard()
    {
        $data['menu_aktif'] = "dashboard";
        return view(env('APP_THEME').'.page.dashboard', $data);
    }

    public function themesChange()
    {
        session('themes', request('to'));
        
        return redirect('dashboard');
    }
}
