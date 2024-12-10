<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Persistence\Eloquent\User\UserRegisterModel;
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
        $user = UserRegisterModel::all();

        return response()->json(compact('user'), 201);
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
            'email' => 'required',
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
            'image' => $data['image'],
        ]);


        return response()->json(compact('user'), 201);
    }

    public function apiLogin(Request $request)
    {
        $credentials = $request->all();

        $loginUser = $request->validate($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->fails()) {
            return response()->json($request->errors(), 400);
        }

        $user = DB::table('user_register')
            ->where('email', $request->email)
            ->where('password', Hash::make($request->password))
            ->first();

        if (Auth::attempt($loginUser)) {
            $request->session()->regenerate();
        }

        return response()->json(compact('user'), 201);
    }
}
