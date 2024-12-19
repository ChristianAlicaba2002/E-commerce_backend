<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\User\UserRegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


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
            'email' => 'required|email|unique,user_register,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image',
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
            'status' => true,
            'message' => 'Registration successful, you can now login',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ],200);
    }

    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email or Password is incorrect',
            ], 422);
        }

        $user = DB::table('user_register')
        ->where('email' , $request->email)
        ->where('password',$request->password)->first();

        if(Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Login successful' . $user->email,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ], 200);
        }

       
    }

        
}
