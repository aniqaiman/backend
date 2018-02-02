<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;

use App\Buyer;

class BuyerController extends Controller
{
    public function createBuyer(Request $request)
    {
    	if($request->ajax()){
    		$buyers = new Buyer;
    		$buyers->owner_name = $request->owner_name;
    		$buyers->company_name = $request->company_name;
    		$buyers->company_reg_number = $request->company_reg_number;
    		$buyers->ic_number = $request->ic_number;
    		$buyers->company_address = $request->company_address;
    		$buyers->phone_number = $request->phone_number;
    		$buyers->handphone_number = $request->handphone_number;
    		$buyers->email_address = $request->email_address;
    		$buyers->password = bcrypt('$request->password');
    		$buyers->save();
    		return response($buyers);
    	}
    }

    public function getBuyer()
    {
    	$buyers = Buyer::all();
    	return view('buyer.buyer', compact('buyers'));
    }

    public function editBuyer($buyer_id, Request $request)
    {
    	$buyers = Buyer::where('buyer_id', $request->$buyer_id)->first();
    	return view('buyer.buyer', compact('buyers'));
    }

    public function updateBuyer(Request $request)
    {
    	if($request->ajax()){
    		$buyers = Buyer::where('buyer_id', $request->buyer_id)->first();
    		$buyers->owner_name = $request->owner_name;
    		$buyers->company_name = $request->company_name;
    		$buyers->company_reg_number = $request-$company_reg_number;
    		$buyers->ic_number = $request->ic_number;
    		$buyers->company_address = $request->company_address;
    		$buyers->phone_number = $request->phone_number;
    		$buyers->handphone_number = $request->handphone_number;
    		$buyers->email_address = $request->email_address;
    		// $buyers->password = bcrypt('$request->password');
    		$buyers->save();
    		return response($buyers);
    	}
    }

    public function deleteBuyer($buyer_id, Request $request)
    {
    	$buyers = Buyer::find($buyer_id);
    	$buyers->delete();
    	Session::flash('message','Successfully deleted!');
    	return Redirect::to('buyers');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}