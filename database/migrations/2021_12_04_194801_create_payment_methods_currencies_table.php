<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods_currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained('currencies');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->unsignedDecimal('min_deposit', $precision = 8, $scale = 2)->default(0);
            $table->unsignedDecimal('max_deposit', $precision = 8, $scale = 2)->default(0);
            $table->unsignedDecimal('min_withdrawal', $precision = 8, $scale = 2)->default(0);
            $table->unsignedDecimal('max_withdrawal', $precision = 8, $scale = 2)->default(0);
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods_currencies');
    }
}
