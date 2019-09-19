<?php

namespace App\Http\Controllers\API\v1;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class RegisterController extends Controller
{

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'mail' => 'required|email|unique:users',
            'passwd'=> 'required|min:3|confirmed',
        ]);

        $authToken = hash('sha256', Str::random(60));
        $user = new User([
            'name' => request('firstname'),
            'email' => request('mail'),
            'password' => Hash::make(request('passwd')),
            'token' => $authToken
        ]);
            
        return response()->json([
            'data' => [
                'user' => $user, 
                'token' => $user->createAuthToken()
            ]
        ], 201);

    }
}