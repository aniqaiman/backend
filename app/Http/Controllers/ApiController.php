<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('company_reg_ic_number', 'password');
        //var_dump($credentials);
        //exit();
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid company_reg_ic_number or password.',
                ], 401);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'message' => 'Failed to generate token.',
            ], 500);
        }
        return response()->json([
            'token' => $token,
        ]);
    }

    public function getAuthUser(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $newuser['user_id'] = $user->user_id;
        $newuser['name'] = $user->name;
        $newuser['email'] = $user->email;
        $newuser['address'] = $user->address;
        $newuser['phonenumber'] = $user->phonenumber;
        $newuser['profilepic'] = $user->profilepic;
        $newuser['company_name'] = $user->company_name;
        $newuser['company_reg_ic_number'] = $user->company_reg_ic_number;
        $newuser['handphone_number'] = $user->handphone_number;
        $newuser['bank_name'] = $user->bank_name;
        $newuser['bank_acc_holder_name'] = $user->bank_acc_holder_name;
        $newuser['bank_acc_number'] = $user->bank_acc_number;
        $newuser['latitude'] = $user->latitude;
        $newuser['longitude'] = $user->longitude;
        $newuser['group_name'] = $user->groups->group_name;
        $newuser['created_at'] = $user->created_at;
        $newuser['updated_at'] = $user->updated_at;
        $newuser['buss_hour'] = $user->buss_hour;

        return response()->json([
            'data' => $newuser,
            'status' => 'ok',
        ]);
    }

}
