<?php 

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $path = $request->file('profilepic')->store('public/images');
		if($request->ajax()){
            $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->address = $request->address;
            $users->phonenumber = $request->phonenumber;
            $users->profilepic = $path;
            $users->save();
            return response($users);
		}
	}

	public function getUser()
	{
    	$users = User::all();
    	return view('user.user', compact('users'));
    }

    public function editUser($user_id, Request $request)
    {
        $users = User::where('user_id', $request->user_id)->first();
        return view('user.editUser', compact('users'));
    }

    public function updateUser(Request $request)
    {
        $path = $request->file('profilepic')->store('public/images');
        if($request->ajax()){
            $users = User::where('user_id', $request->user_id)->first();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->address = $request->address;
            $users->phonenumber = $request->phonenumber;
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

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
    