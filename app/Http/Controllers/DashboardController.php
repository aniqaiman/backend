<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        if ($request->ajax()) {
            return response(Product::create($request->all()));
        }
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
