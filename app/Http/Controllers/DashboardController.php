<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Dashboard;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    	{
    		if($request->ajax()){
    			return response(Dashboard::create($request->all()));
    		}
    	}

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}