<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->user_type === 'admin') {
            return redirect()->route('admin.dashboard'); 
        }
        return view('admin.login');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->user_type === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'You are not authorized to access this page.']);
        }

        return back()->withErrors(['password' => 'The provided credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
