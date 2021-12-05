<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Wallet extends Pivot
{
    public $timestamps = true;
    public $guarded = ['id'];
    protected $table = "wallets";
}
