<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentOtherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payment_others', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_id');
            $table->integer('bill_payment_id');
            $table->text('procedure_code_master_id')->nullable();
            $table->integer('bill_service_id');
            $table->text('procedure_code')->nullable();
            $table->text('procedure_unit')->nullable();
            $table->text('procedure_charge')->nullable();
            $table->text('expected_fee_amt')->nullable();
            $table->text('calculated_br_amt'); 
            $table->text('procedure_payment_total')->nullable();
            $table->text('original_submission_amt')->nullable();
            $table->text('bill_payment_total_amt')->nullable();
            $table->text('due_balace_amt')->nullable();
            $table->text('expected_fee_percent')->nullable();
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
        Schema::dropIfExists('bill_payment_others');
    }
}
