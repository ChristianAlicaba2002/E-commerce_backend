<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\Product\UserAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    //
    public function displayUser()
    {
        // $user = DB::table('user_api')->where('id', Auth::user()->id)->first();
        $user = DB::table('user_api')->get();

        return response()->json(compact('user'), 200);
    }

    public function apiRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:user_api',
            'email' => 'required|string|unique:user_api',
            'password' => 'required|string|min:5|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = UserAPI::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'min:5', 'max:15'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::UserAPI();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
