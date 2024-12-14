<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\User\UserRegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserApiController extends Controller
{
    //
    public function displayUser()
    {
        $UserRegistered = UserRegisterModel::all();

        return response()->json(compact('UserRegistered'), 201);
    }

    public function apiRegister(Request $request)
    {
        Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'birthMonth' => 'required',
            'birthDay' => 'required',
            'birthYear' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:user_register,email',
            'password' => 'required',
            'image' => 'required',
        ]);

        $data = [];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

            $user = UserRegisterModel::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'birthMonth' => $request->birthMonth,
            'birthDay' => $request->birthDay,
            'birthYear' => $request->birthYear,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $data['image']
        ]);

        return response()->json([
            'status' => 'success',
            'register' => $user,
            'message' => 'register successfully',
        ],200);

        return response()->json([
            'status' => 'error',
            'register' => $user,
            'message' => 'Error Registration',
        ], 400);
    }

    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json('Login Unssucessful');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'message' => 'Login successful',
            ], 200);
        }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
    }
}
