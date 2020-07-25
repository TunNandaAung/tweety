<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\User;

class AuthController extends BaseApiController
{
    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', request('email'))->first();

        if (!$user || !Hash::check(request('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken(request('email'))->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'user_id' => $user->id,
            'username' => $user->username
        ]);
    }

    public function register()
    {
        $validator = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::create([
            'name' => $validator['name'],
            'username' => $validator['username'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        $token = $user->createToken(request('email'))->plainTextToken;

        return $this->sendResponse(
            [
                'token' => $token,
                'user_id' => $user->id,
                'username' => $user->username
            ],
            '',
            201
        );
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return $this->sendResponse([], 'User logged out!');
    }
}
