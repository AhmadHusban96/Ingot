<?php

namespace App\Models;

use App\Models\Pivots\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = "currencies";
    protected $guarded = ['id'];


    public function paymentMethods()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            PaymentMethod::class,
            'payment_methods_currencies',
            'currency_id',
            'payment_method_id')->withTimestamps();
    }

    public function wallets()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Wallet::class,
            'wallets',
            'currency_id',
            'wallet_id')->withTimestamps();
    }
}
