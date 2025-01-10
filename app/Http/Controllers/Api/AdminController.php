<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Admin\BranchesModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function DisplayBranchDashboard()
    {
        $branches = DB::table('branches')->where('branch_id', Auth::guard('branches')->user()->branch_id)->first();

        return view('components/branchAdmin/atoms/DisplayBranchesDashboard', compact('branches'));
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:5', 'max:15'],
        ]);

        if (Auth::guard('branches')->attempt($request->only(['branch_name', 'password']))) {
            $request->session()->regenerate();
            $user = Auth::User();

            return redirect('/');
        }

        return redirect('/')->with('revoke', 'Account Branch not found');
    }

    public function updateBranchInformation(Request $request, $branch_id)
    {
        $branch = BranchesModel::where('branch_id', $branch_id)->first();
        
        if (!$branch) {
            return redirect('/DisplayBranchDashboard')->with('error', 'Branch not found');
        }

        $incomingDetails = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|string',
        ]);

        if ($incomingDetails->fails()) {
            return redirect('/DisplayBranchDashboard')->with('error', 'All fields are required');
        }

        $branch->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect('/DisplayBranchDashboard')->with('success', 'Branch status updated successfully');
    }

    public function forgotPassword(Request $request)
    {
        $incomingDetails = Validator::make($request->all(), [
            // 'branch_name' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($incomingDetails->fails()) {
            return redirect('/ForgotpassPage')->with('error', 'All fields are required');
        }

        $user = BranchesModel::
        // where('branch_name', $request->branch_name)
            where('first_name', $request->first_name)
                ->where('last_name', $request->last_name)
                ->where('address', $request->address)
                ->where('email', $request->email)
                ->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'Account not found');
        }

        return redirect()->route('new.password.form', [
            $user->branch_name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'address' => $user->address,
            'email' => $user->email,
        ]);
    }

    public function showNewPasswordForm($branch_name, $first_name, $last_name, $address, $email)
    {
        return view('components.branchAdmin.atoms.NewPassword', compact('branch_name', 'first_name', 'last_name', 'address', 'email'));
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

        if (! preg_match('/[A-Z]/', $request->new_password)) {
            return back()->with('error', 'Password must contain at least one Uppercase letter.');
        }

        if (! preg_match('/[0-9]/', $request->new_password)) {
            return back()->with('error', 'Password must contain at least one Number.');
        }

        if (Str()->length($request->new_password) < 5) {
            return back()->with('error', 'Password must be at least 5 characters long.');
        }

        $user = BranchesModel::where('branch_name', $request->branch_name)->first();

        if (! $user) {
            return redirect('/ForgotpassPage')->with('error', 'User not found');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/')->with('success', 'Please login with your new password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
