<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class UserAuth
{
    public function auth($request)
    {
        $validator = Validator::make($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return auth()->user();
        }
        return null;
    }
}
