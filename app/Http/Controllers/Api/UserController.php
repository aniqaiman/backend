<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postRegisterUser(Request $request)
    {
        $checkEmail = User::where('email', $request->input('email'))->first();

        if (User::where('email', $request->input('email'))->exists()) {
            return response()->json([
                'message' => 'The email had been used.',
            ], 403);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'handphone_number' => $request->input('handphone_number'),
            'password' => bcrypt($request->input('password')),
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
