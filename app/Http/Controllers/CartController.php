<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    public function add(Request $request, $id) {
        $request->validate([
            "qty" => "required"
        ]);

        Cart::create([
            "customer_id" => Auth::id(),
            "product_id" => $id,
            "qty" => $request->qty
        ]);

        return redirect()->back()->with("success", "success add product to cart");
    }
}
