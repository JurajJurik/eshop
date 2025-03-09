<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['invoice_number', 'user_id', 'name', 'email', 'currency', 'products', 'quantity','total_price_without_VAT', 'total_price', 'order_address', 'shipping_address', 'shipping_method', 'order_status', 'coupon', 'invoice_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
