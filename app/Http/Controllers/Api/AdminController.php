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
            'branchname' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'password' => 'required|string|min:3',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        if (DB::table('users')->where('branchname', $request->branchname)->exists()) {
            return redirect('/')->with('error', 'The Branch name is already exist , please make a new one.');
        }

        $user = User::create([
            'branchname' => $request->branchname,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        // auth::login($user);

        $token = $user->createToken('admin_user')->plainTextToken;

        return redirect('/')->with('success', 'Registered successfully!');
    }

    public function login(Request $request): RedirectResponse
    {

        $credentials = $request->validate([
            'branchname' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('access', 'Login Successfully');
        } else {
            return redirect('/')->with('revoke', 'Username or Password is incorrect');
        }

    }

    public function forgotPassword(Request $request)
    {
        $incomingDetails = Validator::make($request->all(), [
            'branchname' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        if ($incomingDetails->fails()) {
            return redirect('/ForgotpassPage')->with('error', 'Please fill in all required fields');
        }

        $user = User::where('branchname', $request->branchname)
            ->where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'Account not found');
        }

        // Generate a random temporary password
        $tempPassword = substr(md5(rand()), 0, 8);

        // Update user's password
        $user->password = Hash::make($tempPassword);
        $user->save();

        // In a real application, you would typically send this via email
        return redirect('/')->with('success', 'Your temporary password is: '.$tempPassword);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
