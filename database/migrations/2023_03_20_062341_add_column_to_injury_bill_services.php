<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToInjuryBillServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('injury_bill_services', function (Blueprint $table) {
            //
            $table->integer('master_bill_charge_id')->nullable(); //table name (master_bill_charges_sheet)
            $table->integer('task_id')->nullable();
            $table->integer('provider_charge_id')->nullable(); //provider_charge
            $table->double('charge')->nullable();
            $table->double('expected_fee_schedule')->nullable();
            $table->double('calculated_br_reduction')->nullable();
            $table->double('original_submission_payment')->nullable();
            //$table->double('master_unit_amount')->nullable();
            $table->integer('master_procedure_code_charge_id')->nullable();
            $table->double('total_bill_amount')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('is_master_found')->nullable();
            //$table->foreign('master_procedure_code_charge_id')->references('id')->on('billing_provider_charge_procedure_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('injury_bill_services', function (Blueprint $table) {
            //
        });
    }
}
