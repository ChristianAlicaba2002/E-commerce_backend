<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Branches;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function loginSuperAdmin(Request $request){
        Validator::make($request->all() , [
            'admin' => 'required|string',
            'password' => 'required|string',
        ]);
        // DB::table('super_admin')->where('admin',$request->admin)->where('password',$request->password)
        if(Auth::attempt($request->only(['admin','password']))){
            $request->session()->regenerate();
            return redirect('/Dashboard')->with('success' , 'Login Successfully');
        }else{
            return redirect('/')->with('error' , 'Admin account not found');

        }
    }

    public function logoutSuperAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AddBranch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required',
            'branchname' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string|in:Compostela Cebu,Liloan Cebu,Consolacion Cebu,Mandaue City,Lapu-Lapu City,Banilad City,Talisay City,Cebu City',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
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

        $branch_id = $this->generateUniqueBranchID();

        $user = Branches::create([
            'branch_id' => $branch_id,
            'branchname' => $request->branchaname,
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('admin_user')->plainTextToken;

        return redirect('/')->with('success', 'Registered successfully!');
    }

    private function generateUniqueBranchID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
            // Check if the generated ID already exists
            $exists = DB::table('branches')->where('branch_id' , $id);
        } while ($exists !== null); // Ensure the ID is unique

        return $id;
    }

    //  Generate a randomnumericId.
    private function generateRandomAlphanumericID(int $length = 10): string
    {
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);

        return $result;
    }
}
