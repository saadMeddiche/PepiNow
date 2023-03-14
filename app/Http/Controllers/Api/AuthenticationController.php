<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginFormValidation;
use App\Http\Requests\RegisterFormValidation;

class AuthenticationController extends Controller
{
    public function login(LoginFormValidation $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('ProjectToken');

            $response = [
                'user' => $user,
                'token' => $token
            ];

            // 201 Mean that created something and it is successful
            return response($response, 201);
        } else {

            return response(['message' => 'Invalid Password'], 401);
        }
    }

    public function register(RegisterFormValidation $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('ProjectToken');

        $response = [
            'user' => $user,
            'token' => $token
        ];

        // 201 Mean that created something and it is successful
        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged Out Successfully']);
    }
}
