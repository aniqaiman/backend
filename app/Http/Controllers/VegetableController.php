<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use Redirect;
use App\Vegetable;

class VegetableController extends Controller
{
    public function createVegetable(Request $request)
    {
    	$path = $request->file('vegetable_image')->store('public/images');
		if($request->ajax()){
            $vegetables = new Vegetable;
            $vegetables->vegetable_name = $request->vegetable_name;
            $vegetables->vegetable_grade = $request->vegetable_grade;
            $vegetables->vegetable_price = $request->vegetable_price;
            $vegetables->vegetable_image = $path;
            $vegetables->vegetable_quantity = $request->vegetable_quantity;
            $vegetables->vegetable_harvest_duration = $request->vegetable_harvest_duration;
            $vegetables->save();
            return response($vegetables);
        }
    }

    public function getVegetable()
    {
    	$vegetables = Vegetable::all();
	    // $users = User::all();
	    return view('vegetable.vegetable',compact('vegetables'));
    }

    public function editVegetable($vegetable_id, Request $request)
    {
        $vegetables = Vegetable::where('vegetable_id', $request->vegetable_id)->first();
        return view('vegetable.editVegetable', compact('vegetables'));
    }

    public function updateVegetable(Request $request)
    {
    	$path = $request->file('vegetable_image')->store('public/images');
        if($request->ajax()){
            $vegetables = Vegetable::where('vegetable_id', $request->vegetable_id)->first();
            $vegetables->vegetable_name = $request->vegetable_name;
            $vegetables->vegetable_grade = $request->vegetable_grade;
            $vegetables->vegetable_price = $request->vegetable_price;
            $vegetables->vegetable_image = $path;
            $vegetables->vegetable_quantity = $request->vegetable_quantity;
            $vegetables->vegetable_harvest_duration = $request->vegetable_harvest_duration;
            $vegetables->save();
            return response($vegetables);
            }       
    }

    public function deleteVegetable($Vegetable_id, Request $request)
    {
        $vegetables = Vegetable::find($vegetable_id);
        $vegetables->delete();
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('vegetable');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
