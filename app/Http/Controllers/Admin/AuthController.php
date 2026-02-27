<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = AdminUser::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_logged_in' => true, 'admin_username' => $admin->username]);
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid username or password.')->withInput(['username' => $request->username]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
