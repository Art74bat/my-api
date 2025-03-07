<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index ()
    {
        $users = User::query()->get();
        return UserResource::collection($users);
    }
    public function register(UserRequest $request)
    {

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        $user->createToken($request->name);
        return [
            'user'=>$user->id,

        ];
    }
    public function login(LoginRequest $request)
    {

        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return [
                'errors' => [
                    'email'=>['You credentials are not valid']
                ]
            ];
        }

        $token = $user->createToken($user->name);
        return [
            'user'=>new UserResource($user),
            'token'=>$token->plainTextToken,
        ];
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message'=>'You are logged out'
        ];
    }
    public function show (Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }
    public function update (UpdateRequest $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        return response()->json([
            'message'=>'data was updated',
        ]);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message'=>'user was deleted',
        ]);
    }
}
