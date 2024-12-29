<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function loginSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('/LoginSuperAdmin')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        if (Auth::guard('admin')->attempt($request->only(['admin', 'password']))) {
            $request->session()->regenerate();

            return redirect('/LoginSuperAdmin')->with('success', 'Welcome Back');
        }

        return redirect('/LoginSuperAdmin')
            ->with('error', 'Invalid credentials')
            ->withInput($request->except('password'));
    }

    public function logoutSuperAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/LoginSuperAdmin');
    }
}
