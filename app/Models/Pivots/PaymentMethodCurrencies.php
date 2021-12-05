<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PaymentMethodCurrencies extends Pivot
{
    public $timestamps = true;
    public $guarded = ['id'];
    protected $table = "payment_methods_currencies";
}
