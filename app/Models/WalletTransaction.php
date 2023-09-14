<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'amount', 'status', 'payment_status', 'customer_id', 'type'];

    public function customer()
    {
        return $this->hasMany(Customer::class, 'customer_id');
    }

}
