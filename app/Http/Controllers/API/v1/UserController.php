<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ]);


        return response()->json([
            'message' => 'Account Created Successfully',
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            $userData = [];
            $userData['id'] = $user->id;
            $userData['name'] = $user->name;
            $userData['email'] = $user->email;

            return response()->json([
                'message' => 'Login Success!',
                'data' => ['user' => $userData,'token' => $token]
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['Provided Credentials are Incorrect']
        ]);
    }


    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function refresh(Request $request)
    {
        $request->user()->tokens()->delete();

        $token = $request->user()->createToken('authToken')->plainTextToken;
        
        return response()->json(['token' => $token]);
    }
}
