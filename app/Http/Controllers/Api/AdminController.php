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
            'password' => 'required|string|min:5|max:15',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($request->password !== $request->confirm_password) {
            return back()->with('error', 'Please match your password ');

        }

        if (!preg_match('/[A-Z]/', $request->password)) {
            return back()->with('error', 'The password must contain at least one Uppercase letter.');
        }

        if (!preg_match('/[0-9]/', $request->password)) {
            return back()->with('error', 'The password must contain at least one Number.');
        }

        if (Str()->length($request->password) < 5) {
            return back()->with('error', 'The password must be at least 5 Characters long.');
        }

        if (DB::table('users')->where('branchname', $request->branchname)->exists()) {
            return back()->with('error', 'The Branch name is already exist , please make a new one.');
        }

        $user = User::create([
            'branchname' => $request->branchname,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        $token = $user->createToken('admin_user')->plainTextToken;

        return redirect('/LoginPage')->with('success', 'Registered successfully!');
    }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'firstname' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5', 'max:15'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/LoginPage')->with('access', 'Welcome Back ' . $request->firstname);
        } else {
            return redirect('/LoginPage')->with('revoke', 'Account Admin not found');
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
            return redirect('/ForgotpassPage')->with('error', 'All fields are required');
        }

        $user = User::where('branchname', $request->branchname)
            ->where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'Account not found');
        }

        return redirect()->route('new.password.form', ['branchname' => $user->branchname, 'firstname' => $user->firstname, 'lastname' => $user->lastname]);
    }

    public function showNewPasswordForm($branchname, $firstname, $lastname)
    {
        return view('atoms.NewPassword', ['branchname' => $branchname, 'firstname' => $firstname, 'lastname' => $lastname]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branchname' => 'required|string',
            'new_password' => 'required|string|min:5|max:15',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if (Str()->length($request->new_password) < 5) {
            return back()->with('error', 'The password must be at least 5 characters long.');
        }

        if ($validator->fails()) {
            return back()->with('error', 'Please match your password.');
        }

        $user = User::where('branchname', $request->branchname)->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'User not found');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/LoginPage')->with('success', 'Please login with your new password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
