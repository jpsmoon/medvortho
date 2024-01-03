<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payment_information', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->text('payment_tab_id')->nullable();
            $table->text('payment_amount')->nullable();
            $table->text('refence_number')->nullable();
            $table->text('payment_effective_date')->nullable();
            $table->text('payment_from')->nullable(); 
            $table->enum('payment_deposite', array('1', '2'))->default('1')->comment('1 for deposit and 2 for no deposit');
            $table->text('payment_deposit_date')->nullable();
            $table->text('payer_claim_control_cumber')->nullable(); 
            $table->enum('panality_or_interest_paid', array('1', '2'))->default('1')->comment('1 for panality and 2 for interest paid');
            $table->enum('bill_close', array('1', '2'))->default('1')->comment('1 for yes and 2 for no');
            $table->enum('payment_status', array('1', '2','3'))->default('1')->comment('1 for post and 2 for pending 3 for deleted');
            $table->enum('payment_type', array('1', '2'))->default('1')->comment('1 for origin and 2 for second');
            $table->integer('template_document_id')->nullable();
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
        Schema::dropIfExists('bill_payment_information');
    }
}
