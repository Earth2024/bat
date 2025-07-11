<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BinaryLoginController extends Controller{

    public function showLoginForm() {
        return view('frontend.page.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|min:5|max:150',
            'password' => 'required|min:6|max:150',
        ]);
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function dashboard() {
        return view('backend.dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}