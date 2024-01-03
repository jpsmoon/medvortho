<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentMultipleClaimNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payment_multiple_claim_number', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->integer('bill_payment_id');
            $table->text('payer_claim_control_cumber')->nullable(); 
            $table->enum('panality_or_interest_paid', array('1', '2'))->default('1')->comment('1 for panality and 2 for interest paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_payment_multiple_claim_number');
    }
}
