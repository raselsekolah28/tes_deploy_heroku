<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detail() {
        return $this->hasMany(Detail_Transaction::class, "transaction_id");
    }

    public function customer() {
        return $this->belongsTo(User::class, "customer_id");
    }
}
