<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            $accessToken = md5(Str::random(20));

            $user->access_token = $accessToken;

            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Login sucessfull',
                'data' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login un-sucessfull',
            'data' => null
        ]);
    }
}
