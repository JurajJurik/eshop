<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    public static array $paymentMethod = ['credit or debit card', 'google pay', 'account transfer', 'cryptocurrency', 'cash on delivery'];

    public static array $deliveryMethod = ['delivery box', 'personal pickup - shop', 'personal pickup - partner shop', 'home delivery'];
}
