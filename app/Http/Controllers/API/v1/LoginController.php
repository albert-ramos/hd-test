<?php

namespace App\Http\Controllers\API\v1;

use App\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{

    public function login(Request $request) {

        $this->validate($request, [
            'mail' => 'required',
            'passwd' => 'required'
        ]);
        
        $user = User::isLoginValid([
            'email' => $request->get('mail'),
            'password' => $request->get('passwd')
        ]);

        if( !$user ) {
            $data = [
                'data' => [
                    'data' => [
                        'error' => true,
                        'message' => 'User not found',
                    ]
                ], 
                'status' => 401
            ];

        } else {
            $data = [
                'data' => [
                    'data' => [
                        'error' => false,
                        'message' => 'Logged in successfully',
                        'user' => $user,
                        'token' => $user->createAuthToken()
                    ]
                ],
                'status' => 200
            ];
        }

        return response()->json($data['data'], $data['status']);
        
    }

    
}