<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInjuryBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('injury_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('injury_id')->unsigned()->nullable();
            $table->foreign('injury_id')->references('id')->on('patient_injuries');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('diagnosis_code_type');
            $table->date('dos')->nullable();
            $table->integer('bill_place_of_service')->nullable();
            $table->integer('bill_rendering_provider')->nullable();
            $table->string('bill_practice_bill_id')->nullable();
            $table->string('bill_authorization_number')->nullable();
            $table->date('bill_adminssion_date')->nullable();
            $table->string('bill_provider_type')->nullable();
            $table->string('bill_additiona_information_box')->nullable();
            $table->string('work_dg_code_id')->nullable();
            $table->enum('status', array('1', '0'))->default('0');
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
        Schema::dropIfExists('injury_bills');
    }
}
