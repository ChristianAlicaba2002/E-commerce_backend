<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserApiController extends Controller
{
    //
    public function displayUser()
    {
        $UserRegistered = DB::table('user_register')->get();

        return response()->json(compact('UserRegistered'), 201);
    }

    public function apiRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'birthMonth' => 'required|string',
            'birthDay' => 'required|numeric',
            'birthYear' => 'required|numeric',
            'gender' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (DB::table('user_register')->where('email', $request->email)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Email already exists',
            ], 401);
        }

        // $data = [];
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $data['image'] = $imageName;
        // }

        $user = UserRegister::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'birthMonth' => $request->birthMonth,
            'birthDay' => $request->birthDay,
            'birthYear' => $request->birthYear,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration successful, you can now login',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 200);
    }

    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = UserRegister::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }
}
