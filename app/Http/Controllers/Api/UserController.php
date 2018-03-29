<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function postRegisterUser(Request $request)
    {
        $checkEmail = User::where('email', $request->get('email'))->first();

        if (User::where('email', $request->get('email'))->exists()) {
            return response()->json([
                'message' => 'The email had been used.',
            ], 403);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'handphone_number' => $request->get('handphone_number'),
            'password' => bcrypt($request->get('password')),
            'group_id' => 1,
        ]);

        return response()->json(['data' => $user, 'status' => 'ok']);
    }

    public function getUsers(Request $request)
    {
        $users = User::where('group_id', 1)->get();

        $userArray = [];

        foreach ($users as $user) {
            $newuser["user_id"] = $user->user_id;
            $newuser["name"] = $user->name;
            $newuser["email"] = $user->email;
            $newuser["address"] = $user->address;
            $newuser["handphone_number"] = $user->handphone_number;
            $newuser["group_id"] = $user->group_id;

            array_push($userArray, $newuser);
        }

        return response()->json(['data' => $userArray, 'status' => 'ok']);
    }

    public function getUser($user_id, Request $request)
    {
        $user = User::where('user_id', $user_id)->first();

        $newuser["user_id"] = $user->user_id;
        $newuser["name"] = $user->name;
        $newuser["email"] = $user->email;
        $newuser["address"] = $user->address;
        $newuser["handphone_number"] = $user->handphone_number;
        $newuser["group_id"] = $user->group_id;

        return response()->json(['data' => $newuser, 'status' => 'ok']);
    }
}
