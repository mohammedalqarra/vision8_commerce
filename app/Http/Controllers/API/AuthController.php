<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        // $user = User::where('email' , $request->email)->first();

        $user = User::where('email', $request->email)->first();
        if($user) {

            if(Hash::check($request->password, $user->password)) {

                Auth::login($user);

                $token = $user->createToken('login')->plainTextToken;

                return response()->json([
                    'message' => 'Login Successfully',
                    'status' => 'Success',
                    'data' => [
                        'token' => $token
                    ]
                ], 200);

            }else {
                return response()->json([
                    'message' => 'Password does Not Match',
                    'status' => 'Success',
                    'data' => []
                ], 200);
            }

        }else {
            return response()->json([
                'message' => 'No User Found',
                'status' => 'Success',
                'data' => []
            ], 404);
        }
    }
}
