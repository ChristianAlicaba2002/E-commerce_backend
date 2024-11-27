<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'password' => 'required|string|min:3',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        if (DB::table('users')->where('firstname', $request->firstname)->exists()) {
            return redirect('/')->with('error', 'This firstname already exist , please make a new one.');
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        // auth::login($user);

        $token = $user->createToken('admin_user')->plainTextToken;

        return redirect('/')->with('success', 'Admin registered successfully!');
    }

    public function login(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'firstname' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('access', 'Welcome '.$request->firstname);
        } else {
            return redirect('/')->with('revoke', 'Username or Password are incorrect');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
