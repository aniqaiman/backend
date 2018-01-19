<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
    	if($request->ajax()){
			return response(Group::create($request->all()));
		}
    }

    public function getGroup()
    {
    	$groups = Group::all();
	    $users = User::all();
	    return view('group.group',compact('groups', 'users'));
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
