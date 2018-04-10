<?php

namespace App\Http\Controllers;

use App\Group;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Session;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $path = $request->file('profilepic')->store('public/images');
        if ($request->ajax()) {
            $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->address = $request->address;
            $users->handphone_number = $request->handphone_number;
            $users->profilepic = $path;
            $users->group_id = 1;
            $users->save();
            return response($users);
        }
    }

    public function getUser()
    {
        $groups = Group::all();
        $users = User::where('group_id', 1)->get();
        $types = Type::all();
        return view('user.user', compact('users', 'types', 'groups'));
    }

    public function editUser($user_id, Request $request)
    {
        $users = User::where('user_id', $user_id)->first();
        return view('user.editUser', compact('users'));
    }

    public function updateUser(Request $request)
    {
        $path = $request->file('profilepic')->store('public/images');
        if ($request->ajax()) {
            $users = User::where('user_id', $request->user_id)->first();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->address = $request->address;
            $users->handphone_number = $request->handphone_number;
            $users->profilepic = $path;
            $users->save();
            return response($users);
        }
    }

    public function deleteUser($user_id, Request $request)
    {
        $users = User::find($user_id);
        $users->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('users');
    }
}
