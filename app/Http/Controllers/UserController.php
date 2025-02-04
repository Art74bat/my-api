<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index ()
    {
        // Get all users
        $users = User::all();

        // Response
        return response()->json([
            "status" => true,
            "user" => $users
        ]);
    }
     // Register (POST - name, email, password)
    public function register(UserRegisterRequest $request){

        // Validation
        $request->validated();
        // dd($request);
        // User model to save user in database
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "isAdmin" => $request->has('isAdmin')? 1 : 0
        ]);
        
        // Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    // Login (POST - email, password)
    public function login(UserLoginRequest $request){
        // Validation
        $request->validated();

        // Check user by email
        $user = User::where("email", $request->email)->first();

        // Check user by password
        if(!empty($user)){

            if(Hash::check($request->password, $user->password)){

                // Login is ok
                $tokenInfo = $user->createToken("myToken");

                $token = $tokenInfo->plainTextToken; // Token value

                return response()->json([
                    "status" => true,
                    "message" => "Login successful",
                    "token" => $token
                ]);
            }
            else{

                return response()->json([
                    "status" => false,
                    "message" => "Password didn't match."
                ]);
            }
        }
        else{

            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ]);
        }
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

    // Profile Update (PUT,PATCH Auth Token)
    public function update(UserUpdateRequest $request){

        $request->validated();
        
        $userData = auth()->user();

        if ($request->method()=="PUT") {
            // Update user data
            $userData->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password) // If password is provided, update it. Otherwise, keep it as it is.
        ]);
        }else{
            // Update user data
            if($request->has('name')){
                $userData->update([
                    "name" => $request->name,
                ]);
            }
            if($request->has('email')){
                $userData->update([
                    "email" => $request->email,
                ]);
            }
            if($request->has('password')){
                $userData->update([
                    "password" => Hash::make($request->password), // If password is provided, update it. Otherwise, keep it as it is.
                ]);
            }
        }


        
        return response()->json([
            "status" => true,
            "message" => "Update Profile information",
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
