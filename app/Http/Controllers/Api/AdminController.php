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

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'branchname' => 'required|string|in:Compostela Cebu,Liloan Cebu,Consolacion Cebu,Mandaue City,Lapu-Lapu City,Banilad City,Talisay City,Cebu City',
    //         'firstname' => 'required|string',
    //         'lastname' => 'required|string',
    //         'address' => 'required|string|in:Compostela Cebu,Liloan Cebu,Consolacion Cebu,Mandaue City,Lapu-Lapu City,Banilad City,Talisay City,Cebu City',
    //         'phone_number' => 'required|numeric',
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:5|max:15',
    //         'confirm_password' => 'required|string|same:password',
    //     ]);

    //     if ($request->password !== $request->confirm_password) {
    //         return back()->with('error', 'Please match your password ');

    //     }

    //     if (!preg_match('/[A-Z]/', $request->password)) {
    //         return back()->with('error', 'The password must contain at least one Uppercase letter.');
    //     }

    //     if (!preg_match('/[0-9]/', $request->password)) {
    //         return back()->with('error', 'The password must contain at least one Number.');
    //     }

    //     if (Str()->length($request->password) < 5) {
    //         return back()->with('error', 'The password must be at least 5 Characters long.');
    //     }

    //     if (DB::table('users')->where('branchname', $request->branchname)->exists()) {
    //         return back()->with('error', 'The Branch name is already exist , please make a new one.');
    //     }

    //     $user = User::create([
    //         'firstname' => 'required|string',
    //         'lastname' => 'required|string',
    //         'address' => 'required|string',
    //         'phone_number' => 'required|numeric',
    //         'email' => 'required|email',
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $token = $user->createToken('admin_user')->plainTextToken;

    //     return redirect('/LoginPage')->with('success', 'Registered successfully!');
    // }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
        ]);

        if ($incomingDetails->fails()) {
            return redirect('/ForgotpassPage')->with('error', 'All fields are required');
        }

        $user = User::where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->where('address', $request->address)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'Account not found');
        }

        return redirect()->route('new.password.form', ['firstname' => $user->firstname, 'lastname' => $user->lastname , 'address' => $user->address , 'phone_number' => $user->phone_number]);
    }

    public function showNewPasswordForm($firstname, $lastname , $address , $phone_number)
    {
        return view('atoms.NewPassword', ['firstname' => $firstname, 'lastname' => $lastname , 'phone_number' => $phone_number]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:5|max:15',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if ($request->new_password !== $request->confirm_password) {
            return back()->with('error', 'Please match your password ');

        }

        if (!preg_match('/[A-Z]/', $request->new_password)) {
            return back()->with('error', 'Password must contain at least one Uppercase letter.');
        }

        if (!preg_match('/[0-9]/', $request->new_password)) {
            return back()->with('error', 'Password must contain at least one Number.');
        }


        if (Str()->length($request->new_password) < 5) {
            return back()->with('error', 'Password must be at least 5 characters long.');
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
