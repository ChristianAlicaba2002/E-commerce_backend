<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Application\Branch\RegisterBranch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BranchingController extends Controller
{
    private RegisterBranch $registerBranch;

    public function __construct(RegisterBranch $registerBranch)
    {
        $this->registerBranch = $registerBranch;
    }

    // public function getBranchDetails($id)
    // {
    //     $branches = DB::table('branches')->where('branch_id', $id)->first();
    //     $specialProducts = DB::table('special_product')->where('branch_id', $id)->get();
    //     $donMacProducts = DB::table('don_mac')->where('branch_id', $id)->get();

    //     return view('components/superAdmin/pages/BranchDetails', compact('branches', 'specialProducts', 'donMacProducts'));
    // }

    public function moreBranchInformation($branch_id, $branch_name, $first_name, $last_name, $address, $phone_number, $email, $status)
    {

        $specialProducts = DB::table('special_product')->where('branch_id', $branch_id)->get();
        $donMacProducts = DB::table('don_mac')->where('branch_id', $branch_id)->get();

        $branches = DB::table('branches')
            ->where('branch_id', $branch_id)
            ->where('branch_name', $branch_name)
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('address', $address)
            ->where('phone_number', $phone_number)
            ->where('email', $email)
            ->where('status', $status)
            ->first();

        return view('components/superAdmin/pages/BranchDetails', compact('branches', 'specialProducts', 'donMacProducts'));
    }

    public function getAllBranch()
    {
        $branches = DB::table('branches')->get();

        return response()->json(compact('branches'), 200);
    }

    public function AddBranch(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'branch_name' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        if (! preg_match('/[A-Z]/', $request->password)) {
            return redirect('/LoginSuperAdmin')->with('error', 'The password must contain at least one Uppercase letter.');
        }

        if (! preg_match('/[0-9]/', $request->password)) {
            return redirect('/LoginSuperAdmin')->with('error', 'The password must contain at least one Number.');

        }

        if (Str()->length($request->password) < 5) {
            return redirect('/LoginSuperAdmin')->with('error', 'The password must be at least 5 Characters long.');
        }

        if (DB::table('branches')->where('branch_name', $request->branch_name)->exists()) {
            return redirect('/LoginSuperAdmin')->with('error', 'The Branch name is already used');
        }

        if (DB::table('branches')->where('email', $request->email)->exists()) {
            return redirect('/LoginSuperAdmin')->with('error', 'The Email is already used');
        }

        if (DB::table('branches')->where('phone_number', $request->phone_number)->exists()) {
            return redirect('/LoginSuperAdmin')->with('error', 'The Phone Number is already used');
        }

        if (DB::table('branches')->where('address', $request->address)->exists()) {
            return redirect('/LoginSuperAdmin')->with('error', 'The Address is already used');
        }

        $id = $this->generateUniqueBranchID();

        // $user = BranchesModel::create([
        //     'branch_id' => $id,
        //     'branch_name' => $request->branch_name,
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'address' => $request->address,
        //     'phone_number' => $request->phone_number,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'status' => 'active',
        // ]);

        $this->registerBranch->create(
            $id,
            $request->branch_name,
            $request->first_name,
            $request->last_name,
            $request->address,
            $request->phone_number,
            $request->email,
            Hash::make($request->password),
            'active',
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString()
        );

        return redirect('/LoginSuperAdmin')->with('success', 'Added Branch Successfully');
    }

    private function generateUniqueBranchID(): string
    {
        do {
            $id = $this->generateRandomAlphanumericID(6);
            $exists = DB::table('branches')->where('branch_id', $id)->exists();
        } while ($exists);

        return $id;
    }

    private function generateRandomAlphanumericID(int $length = 10): string
    {
        $result = substr(bin2hex(random_bytes(ceil($length / 2))), 0, $length);

        return $result;
    }
}
