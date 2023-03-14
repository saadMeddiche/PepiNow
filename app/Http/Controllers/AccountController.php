<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountFormRequest;

class AccountController extends Controller
{
    public function update(AccountFormRequest $request)
    {

        //Store the validated data
        $data = $request->validated();

        $user = User::find(Auth::user()->id);

        if (!Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Incorrect Password'], 400);
        }

        //Update
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->update();

        return response()->json(['message' => 'Your Informations has been Updated Successfuly'], 200);
    }

    public function reset(Request $request)
    {
        $data = $request->validate([
            'current_password' => [
                'required',
                'string',
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',

            ],
            'repeat_password' => [
                'required',
                'string',
                'min:8',
            ],
        ]);

        $user = User::find(Auth::user()->id);

        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['message' => 'Incorrect Password'], 400);
        }

        if ($data['new_password'] != $data['repeat_password']) {
            return response()->json(['message' => 'Please Repeate the same Password'], 400);
        }

        $user->password = Hash::make($data['new_password']);

        $user->update();

        return response()->json(['message' => 'Password has been reseted successfuly'], 200);
    }
}
