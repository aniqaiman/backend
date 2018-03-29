<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\User;

class UserController extends BaseController
{
	public function postRegisterUser(Request $request)
    {
        $checkEmail = User::where('email', $request->get('email'))->first();

        if (User::where('email', $request->get('email'))->exists()) {
            return response('The email had been used.', 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'handphone_number' => $request->get('handphone_number'),
            'password' => bcrypt($request->get('password')),
            'group_id'=> 1,
            ]);

        return response()->json(['data'=>$user, 'status'=>'ok']);
    }

    public function getUsers(Request $request)
    {
        $users = User::where('group_id',1)->get();

        $userArray = [];

        foreach($users as $user)
        {
            $newuser["user_id"] = $user->user_id;
            $newuser["name"] = $user->name;
            $newuser["email"] = $user->email;
            $newuser["address"] = $user->address;
            $newuser["handphone_number"] = $user->handphone_number;
            $newuser["group_id"] = $user->group_id;

            array_push($userArray, $newuser);
        }

        return response()->json(['data'=>$userArray, 'status'=>'ok']);
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

        return response()->json(['data'=>$newuser, 'status'=>'ok']);
    }
}