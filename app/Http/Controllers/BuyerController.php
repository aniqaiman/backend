<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\User;

class BuyerController extends Controller
{
    public function createBuyer(Request $request)
    {
    	if($request->ajax()){
    		$buyers = new User;
    		$buyers->name = $request->name;
    		$buyers->company_name = $request->company_name;
    		$buyers->company_reg_ic_number = $request->company_reg_ic_number;
    		$buyers->address = $request->address;
    		$buyers->phonenumber = $request->phonenumber;
    		$buyers->handphone_number = $request->handphone_number;
    		$buyers->email = $request->email;
    		$buyers->password = bcrypt('$request->password');
            $buyers->group_id = 11;
    		$buyers->save();
    		return response($buyers);
    	}
    }

    public function getBuyer()
    {
    	$buyers = User::where('group_id', 11)->get();
    	return view('buyer.buyer', compact('buyers'));
    }

    public function editBuyer($user_id, Request $request)
    {
    	$buyers = User::where('user_id', $user_id)->first();
    	return view('buyer.editBuyer', compact('buyers'));
    }

    public function updateBuyer(Request $request)
    {
    	if($request->ajax()){
    		$buyers = User::where('user_id', $request->user_id)->first();
    		$buyers->name = $request->name;
            $buyers->company_name = $request->company_name;
            $buyers->company_reg_ic_number = $request->company_reg_ic_number;
            $buyers->address = $request->address;
            $buyers->phonenumber = $request->phonenumber;
            $buyers->handphone_number = $request->handphone_number;
            $buyers->email = $request->email;
            $buyers->password = bcrypt('$request->password');
    		$buyers->save();
    		return response($buyers);
    	}
    }

    public function deleteBuyer($user_id, Request $request)
    {
    	$buyers = User::find($user_id);
    	$buyers->delete();
    	Session::flash('message','Successfully deleted!');
    	return Redirect::to('buyer');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}