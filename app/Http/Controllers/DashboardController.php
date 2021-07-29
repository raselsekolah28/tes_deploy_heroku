<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $products = null;

        if (Auth::user()->role_id === 2) {
            if ($request->search) {
                $products = Product::where("name", $request->search)->orWhere("name", "like", "%" . $request->search . "%")->paginate(10);
            } else {
                $products = Product::paginate(10);
            }
        }

        return view("dashboard.dashboard", compact("products"));
    }
}
