<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:250',
        'email' => 'required|email|max:250|unique:users',
        'password' => 'required|min:8|confirmed'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    Mail::to('brotbrut87@gmail.com')->send(new UserRegistered($user));

    $credentials = $request->only('email', 'password');
    Auth::attempt($credentials);
    $request->session()->regenerate();

    return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
}


    public function register()
    {
        return view('auth.register');
    }


    public function login()
    {
        return view('auth.login');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.'
        ])->onlyInput('email');
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return redirect()->route('buku.index');
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.'
            ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('buku.index')
            ->withSuccess('You have logged out successfully!');
    }
}
