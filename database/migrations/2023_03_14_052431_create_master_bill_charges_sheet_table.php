<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBillChargesSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_bill_charges_sheet', function (Blueprint $table) {
            $table->id();
            $table->string('procedure_code');
            $table->string('base_charge');
            $table->string('procedure_description');
            $table->double('calculation_amount');
            $table->string('procedure_year_2014');
            $table->string('procedure_year_2015');
            $table->string('procedure_year_2016');
            $table->string('procedure_year_2017');
            $table->string('procedure_year_2018');
            $table->string('procedure_year_2019');
            $table->string('procedure_year_2020');
            $table->string('procedure_year_2021');
            $table->string('procedure_year_2022');
            $table->enum('status', array('1', '0'))->default('1');
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
        Schema::dropIfExists('master_bill_charges_sheet');
    }
}
