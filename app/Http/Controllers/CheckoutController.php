<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\{Transaction, Detail_Transaction};

class CheckoutController extends Controller
{
    public function index(Request $request) {
        return view("dashboard.checkout.index");
    }

    public function store(Request $request) {
        foreach (Auth::user()->carts as $key => $value) {
            $transaction = Transaction::create([
                "customer_id" => Auth::id(),
                "date" => date("d-m-y"),
                "code_transaction" => "INV" . date("ymd") . "00" . "--"
            ]);

            $transaction->update([
                "code_transaction" => "INV" . date("ymd") . "00" . $transaction->id
            ]);

            Detail_Transaction::create([
                "product_id" => $value->product_id,
                "qty" => $value->qty,
                "transaction_id" => $transaction->id
            ]);

            $value->delete();
        }

        return redirect()->back()->with("success", "success checkout all product");
    }
}
