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

        // $data = $request->only(['email', 'password']);
        // if(Auth::attempt([$data])){//  تحقق من ال email& password

        // }else {

        // }

        //  return $request->all();
        $user = User::where('email', $request->email)->get();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $token = $user->createToken('login')->plainTextToken;
                return response()->json([
                    'message' => 'login Successfully',
                    'status' => 'Success',
                    'data' => [
                        'token' => $token ,
                    ]
                ], 404); // status
            } else {
                return response()->json([
                    'message' => 'Password does Not Match',
                    'status' => 'Success',
                    'data' => [],
                ], 200); // status
            }
        } else {
            return response()->json([
                'message' => 'No User Found',
                'status' => 'Success',
                'data' => [],
            ], 404); // status
        }
        // Auth::logout();
        // User::create();
        // //bcrypt();
        // Hash::make();

    }



    public function register()
    {
    }
}
