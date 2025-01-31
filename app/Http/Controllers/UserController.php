<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(Request $request){

        // Validation
        $request->validate([
            "name" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed" // password_confirmation
        ]);
        // dd($request);
        // User model to save user in database
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        
        // Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (! Auth::guard('web')->attempt(['email'=>$email,'password'=>$password])) {
            return response()->json([
                'message'=>'Неверный логин или пароль',
            ],401);
        }else {
            // Generate new token for user and update it in database
            $user = Auth::guard('web')->user();

            $token = $user->createToken('login');

            // $user->update(['api_token'=>$token]);

            return response()->json([
                'token'=>$token->plainTextToken,
            ]);
        };
    }

        // Profile (GET, Auth Token)
    public function profile(){
        $userData = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile information",
            "data" => $userData
        ]);
    }
        
        // Logout (GET, Auth Token)
    public function logout(){
        
        // To get all tokens of logged in user and delete that
        request()->user()->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }
    
        // Refresh Token (GET, Auth Token)
    public function refreshToken(){
        
        $tokenInfo = request()->user()->createToken("myNewToken");

        $newToken = $tokenInfo->plainTextToken; // Token value

        return response()->json([
            "status" => true,
            "message" => "Refresh token",
            "acccess_token" => $newToken
        ]);
    }

}
