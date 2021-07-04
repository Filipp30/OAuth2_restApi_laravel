<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MolliePayments extends Model
{
    use HasFactory;

    protected $table = 'mollie_payment';

    protected $fillable = [
        'user_id','order_id','mollie_call_id','profile_id',
        'amount_value','amount_currency',
        'status',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];
}
