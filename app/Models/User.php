<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function role() {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function carts() {
        return $this->hasMany(Cart::class, "customer_id");
    }

    public function getTotal() {
        $data = Auth::user()->carts;
        $total = 0;

        foreach ($data as $key => $value) {
            $total += $value->product->price * $value->qty;
        }

        return $total;
    }

    public function transactions() {
        return $this->hasMany(Transaction::class, "customer_id");
    }
}
